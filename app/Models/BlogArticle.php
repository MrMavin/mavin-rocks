<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogArticle extends Model
{
    protected $table = 'blog_articles';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'published',
    ];

    protected $with = [
        'tags',
        'category',
    ];

    protected $casts = ['created_at' => 'date:M j, Y'];

    protected $appends = [
        'link',
        'created',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
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

    public function getLinkAttribute()
    {
        return $this->attributes['id'].'-'.$this->attributes['slug'];
    }
}
