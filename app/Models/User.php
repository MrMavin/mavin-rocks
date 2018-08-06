<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;

	public $timestamps = FALSE;
	protected $fillable = ['email'];

	public function articles()
	{
		return $this->hasMany(BlogArticle::class);
	}
}
