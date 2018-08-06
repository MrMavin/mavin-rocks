<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
	protected $table = 'blog_articles';

	protected $fillable = ['title', 'slug', 'excerpt', 'content', 'published'];

	protected $with = ['tags', 'user'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function tags()
	{
		return $this->belongsToMany(BlogTag::class);
	}

	public function getCreatedAttribute()
	{
		return $this->created_at->diffForHumans();
	}

	public function getLinkAttribute()
	{
		return $this->id . '-' . $this->slug;
	}

	public function toFormattedArray()
	{
		$data = $this->toArray();

		$tags = '';
		foreach ($data['tags'] as $tag) {
			$tags .= $tag['tag'] . ',';
		}
		$data['tags'] = trim($tags, ',');

		return $data;
	}
}
