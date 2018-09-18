<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogArticleBlogTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('blog_article_blog_tag', function (Blueprint $table) {
            $table->unsignedInteger('blog_article_id');
            $table->unsignedInteger('blog_tag_id');

            $table->foreign('blog_article_id')->references('id')->on('blog_articles')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('blog_tag_id')->references('id')->on('blog_tags')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::dropIfExists('blog_article_blog_tag');
    }
}
