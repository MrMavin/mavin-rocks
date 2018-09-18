<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    public $timestamps = false;

    protected $table = 'blog_categories';

    protected $fillable = ['name'];

    protected $appends = ['slug'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(BlogArticle::class, 'category_id', 'id');
    }

    /**
     * @return string
     */
    public function getSlugAttribute()
    {
        $id = $this->attributes['id'];
        $name = str_slug($this->attributes['name']);

        return "{$id}-{$name}";
    }
}