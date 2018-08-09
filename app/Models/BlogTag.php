<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
	public $timestamps = FALSE;
	protected $table = 'blog_tags';
	protected $fillable = ['tag'];

	public function articles()
	{
		return $this->belongsToMany(BlogArticle::class)
			->where('published', '=', TRUE);
	}
}
