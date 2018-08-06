<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminManageArticleRequest;
use App\Models\BlogArticle;
use App\Models\BlogTag;
use Illuminate\Http\UploadedFile;

class ArticleController extends Controller
{
	public function getList()
	{
		$articles = BlogArticle::orderByDesc('id')->paginate(10);

		return view('admin.article.list', ['articles' => $articles]);
	}

	public function getCreate()
	{
		return view('admin.article.manage', ['edit' => FALSE]);
	}

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

	private function __manageTags(BlogArticle $article, $tags)
	{
		$tags = explode(',', $tags);
		$tagCollection = collect();

		foreach ($tags as $tag) {
			$tagCollection->push(BlogTag::firstOrNew(['tag' => $tag]));
		}

		$article->tags()->detach();
		$article->tags()->saveMany($tagCollection);
	}

	private function __manageImage(BlogArticle $article, UploadedFile $file)
	{
		$filePath = storage_path('app/public/blog');
		$fileName = $article->id . '.jpg';

		$image = \Image::make($file);

		$image->fit(640, 360);
		$image->save("$filePath/$fileName", 70);

		$article->image = 1;
		$article->save();
	}

	private function __redirectToList($action)
	{
		return redirect()->route('admin.blog.article.list')
			->with('notification', [
				'status' => 'success',
				'content' => "Your article has been {$action} successfully"
			]);
	}

	public function getEdit(BlogArticle $article)
	{
		session()->flashInput($article->toFormattedArray());

		return view('admin.article.manage', ['edit' => TRUE]);
	}

	public function postEdit(AdminManageArticleRequest $manageArticleRequest, BlogArticle $article)
	{
		$data = $manageArticleRequest->all();
		$data['published'] = isset($data['published']) ? $data['published'] : FALSE;

		$article->update($data);
		$this->__manageTags($article, $data['tags']);
		if ($manageArticleRequest->hasFile('image')) {
			$this->__manageImage($article, $manageArticleRequest->file('image'));
		}

		return $this->__redirectToList('modified');
	}

	public function postDelete(BlogArticle $article)
	{
		// Exception not handled because impossible in this context
		$article->delete();

		return $this->__redirectToList('deleted');
	}
}