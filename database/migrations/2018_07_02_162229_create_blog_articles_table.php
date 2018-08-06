<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogArticlesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		\Schema::create('blog_articles', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->boolean('published')->default(0);
			$table->boolean('image')->default(0);
			$table->string('title', 255);
			$table->string('slug', 255);
			$table->text('excerpt');
			$table->text('content');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		\Schema::dropIfExists('blog_articles');
	}
}
