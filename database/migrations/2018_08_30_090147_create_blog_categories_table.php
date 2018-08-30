<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('blog_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('position');
            $table->string('name', 64);
        });

        \Schema::table('blog_articles', function (Blueprint $table) {
	        $table->unsignedInteger('category_id')
		        ->nullable()
		        ->after('updated_at');

	        $table->foreign('category_id')
		        ->references('id')
		        ->on('blog_categories')
		        ->onUpdate('cascade')
		        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    \Schema::table('blog_articles', function (Blueprint $table) {
		    $table->dropForeign('blog_articles_category_id_foreign');
		    $table->dropColumn('category_id');
	    });

        \Schema::dropIfExists('blog_categories');
    }
}
