<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
	protected $table = 'blog_articles';
	protected $fillable = ['title', 'slug', 'excerpt', 'content', 'published'];
	protected $with = ['tags', 'user'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany(BlogTag::class);
	}

	/**
	 * @return string
	 */
	public function getCreatedAttribute()
	{
		return $this->created_at->diffForHumans();
	}

	/**
	 * @return string
	 */
	public function getLinkAttribute()
	{
		return $this->id . '-' . $this->slug;
	}

	/**
	 * Transform the Article object in a formatted array
	 * that could be flashed in the session and loaded
	 * by the form components
	 *
	 * @return array
	 */
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
