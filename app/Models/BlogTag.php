<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
	public $timestamps = FALSE;
	protected $table = 'blog_tags';
	protected $fillable = ['tag'];
	protected $appends = ['slug'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function articles()
	{
		return $this->belongsToMany(BlogArticle::class)
			->where('published', '=', TRUE);
	}

	/**
	 * @return string
	 */
	public function getSlugAttribute()
	{
		$id = $this->attributes['id'];
		$name = str_slug($this->attributes['tag']);

		return "{$id}-{$name}";
	}
}
