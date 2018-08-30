<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
	public $timestamps = FALSE;
	protected $table = 'blog_categories';
	protected $fillable = ['name'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function articles()
	{
		return $this->hasMany(BlogArticle::class, 'category_id', 'id');
	}
}