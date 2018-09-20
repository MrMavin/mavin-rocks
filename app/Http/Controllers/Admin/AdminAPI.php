<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminManageArticleRequest;
use App\Http\Resources\BlogArticleResource;
use App\Http\Resources\BlogCategoryResource;
use App\Http\ViewComposers\BlogSidebarComposer;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Symfony\Component\Process\Process;

class AdminAPI extends Controller
{
    public function getArticles()
    {
        $articles = BlogArticle::orderByDesc('id')->with([
                                                             'tags',
                                                             'category',
                                                         ])->get();

        return BlogArticleResource::collection($articles);
    }

    public function getCategories()
    {
        $categories = BlogCategory::orderBy('position')->get();

        return BlogCategoryResource::collection($categories);
    }

    public function getArticle(BlogArticle $article)
    {
        return new BlogArticleResource($article);
    }

    public function postArticleCreate(AdminManageArticleRequest $articleRequest)
    {
        $data = $articleRequest->all();
        $data['slug'] = str_slug($data['title']);

        $article = BlogArticle::create($data);

        if (isset($data['tags'])) {
            $this->__manageTags($article, $data['tags']);
        }

        if ($articleRequest->hasFile('image')) {
            $this->__manageImage($article, $articleRequest->file('image'));
        }

        BlogSidebarComposer::clearSidebarCache();

        return [
            'success' => true,
            'article' => $article->id,
        ];
    }

    public function postArticle(AdminManageArticleRequest $articleRequest, BlogArticle $article)
    {
        $data = $articleRequest->only($article->getFillable());
        $data['published'] = isset($data['published']) ? $data['published'] : false;

        $extra = $articleRequest->except($article->getFillable());

        if (isset($extra['reset_dates']) && $extra['reset_dates']) {
            $now = Carbon::now();

            $article->created_at = $now;
            $article->updated_at = $now;
        }

        if (isset($extra['delete_image']) && $extra['delete_image']) {
            $this->__manageImage($article);
        }

        $article->update($data);

        $this->__manageTags($article, $extra['tags']);

        if ($articleRequest->hasFile('image')) {
            $this->__manageImage($article, $articleRequest->file('image'));
        }

        BlogSidebarComposer::clearSidebarCache();

        return [
            'success' => true,
        ];
    }

    public function postArticleDelete(BlogArticle $article)
    {
        $article->delete();

        BlogSidebarComposer::clearSidebarCache();

        return [
            'success' => true,
        ];
    }

    /**
     * @param BlogArticle $article
     * @param             $tags
     */
    private function __manageTags(BlogArticle $article, $tags)
    {
        $tags = explode(',', $tags);
        $tagCollection = [];

        foreach ($tags as $tag) {
            if (! $tag) // Look for empty tags
            {
                continue;
            }

            $tagCollection[] = BlogTag::firstOrCreate(['tag' => $tag])->id;
        }

        $article->tags()->detach();
        $article->tags()->attach($tagCollection);
    }

    /**
     * @param BlogArticle $article
     * @param UploadedFile $file
     */
    private function __manageImage(BlogArticle $article, UploadedFile $file = null)
    {
        $filePath = storage_path('app/public/blog');
        $fileName = $article->id.'.jpg';
        $fullPath = "$filePath/$fileName";

        if (is_null($file)) {
            @unlink($fullPath);

            $article->image = 0;
            $article->save();

            return;
        }

        $image = \Image::make($file);

        // Resize image to 16:9 ration
        $image->fit(640, 360);
        $image->save($fullPath, 80);

        // Optimize image to reduce size
        $process = new Process("/usr/bin/jpegoptim -m80 -q -s $fileName");
        $process->setWorkingDirectory($filePath);
        $process->run();

        if ($process->getExitCode() != 0) {
            // TODO report error
        }

        $article->image = 1;
        $article->save();
    }
}