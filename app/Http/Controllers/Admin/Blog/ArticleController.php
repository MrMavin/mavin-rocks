<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminManageArticleRequest;
use App\Http\ViewComposers\BlogComposer;
use App\Models\BlogArticle;
use App\Models\BlogTag;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Symfony\Component\Process\Process;

class ArticleController extends Controller
{
	/**
	 * @return \Illuminate\View\View
	 */
	public function getList()
	{
		$articles = BlogArticle::orderByDesc('id')->paginate(10);

		return view('admin.article.list', ['articles' => $articles]);
	}

	/**
	 * Create a new article
	 *
	 * @return \Illuminate\View\View
	 */
	public function getCreate()
	{
		return view('admin.article.manage', ['edit' => FALSE]);
	}

	/**
	 * @param AdminManageArticleRequest $manageArticleRequest
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postCreate(AdminManageArticleRequest $manageArticleRequest)
	{
		$data = $manageArticleRequest->all();
		$data['slug'] = str_slug($data['title']);

		$article = BlogArticle::create($data);

		$this->__manageTags($article, $data['tags']);

		if ($manageArticleRequest->hasFile('image')) {
			$this->__manageImage($article, $manageArticleRequest->file('image'));
		}

		return $this->__redirectToList('created');
	}

	/**
	 * @param BlogArticle $article
	 * @param             $tags
	 */
	private function __manageTags(BlogArticle $article, $tags)
	{
		$tags = explode(',', $tags);
		$tagCollection = collect();

		foreach ($tags as $tag) {
			if (!$tag) // Look for empty tags
				continue;

			$tagCollection->push(BlogTag::firstOrNew(['tag' => $tag]));
		}

		$article->tags()->detach();
		$article->tags()->saveMany($tagCollection);

		BlogComposer::clearMostUsedTags();
	}

	/**
	 * @param BlogArticle  $article
	 * @param UploadedFile $file
	 */
	private function __manageImage(BlogArticle $article, UploadedFile $file)
	{
		$filePath = storage_path('app/public/blog');
		$fileName = $article->id . '.jpg';
		$fullPath = "$filePath/$fileName";

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

	/**
	 * Redirect to the articles list and notify about the operation result
	 *
	 * @param $action
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	private function __redirectToList($action)
	{
		return redirect()->route('admin.blog.article.list')
			->with('notification', [
				'status' => 'success',
				'content' => "Your article has been {$action} successfully"
			]);
	}

	/**
	 * @param BlogArticle $article
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getEdit(BlogArticle $article)
	{
		// Flash article data into session
		session()->flashInput($article->toFormattedArray());

		return view('admin.article.manage', ['edit' => TRUE]);
	}

	/**
	 * @param AdminManageArticleRequest $manageArticleRequest
	 * @param BlogArticle               $article
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postEdit(AdminManageArticleRequest $manageArticleRequest, BlogArticle $article)
	{
		$data = $manageArticleRequest->all();
		$data['published'] = isset($data['published']) ? $data['published'] : FALSE;

		// Since I could save an article as draft it could be helpful to reset
		// the dates. This way when I'll publish the article the creation date
		// won't be in the past
		if ($data['reset_dates'])
		{
			$now = Carbon::now();

			$article->created_at = $now;
			$article->updated_at = $now;
		}

		$article->update($data);

		$this->__manageTags($article, $data['tags']);

		if ($manageArticleRequest->hasFile('image')) {
			$this->__manageImage($article, $manageArticleRequest->file('image'));
		}

		return $this->__redirectToList('modified');
	}

	/**
	 * @param BlogArticle $article
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
	public function postDelete(BlogArticle $article)
	{
		// Exception not handled because impossible in this context
		$article->delete();

		return $this->__redirectToList('deleted');
	}
}