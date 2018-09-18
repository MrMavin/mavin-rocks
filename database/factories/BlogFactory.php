<?php

use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(BlogCategory::class, function (Faker $faker) {
    return [
        'name'     => $faker->company,
        'position' => rand(1, 10),
    ];
});

$factory->define(BlogTag::class, function (Faker $faker) {
    return [
        'tag' => $faker->word,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(BlogArticle::class, function (Faker $faker) {
    $title = ucwords(implode(' ', $faker->words(rand(3, 12))));
    $excerpt = $faker->paragraph(rand(12, 20));

    $text = $faker->realText(3000);

    $content = "<p>{$excerpt}</p><p>{$text}</p>";

    return [
        'published' => true,
        'title'     => $title,
        'slug'      => str_slug($title),
        'excerpt'   => $excerpt,
        'content'   => $content,
    ];
});

$factory->afterCreating(BlogArticle::class, function (BlogArticle $article, Faker $faker) {
    $randomCategory = BlogCategory::all()->random();
    $randomTags = BlogTag::all()->random(rand(2, 5));

    $article->category()->associate($randomCategory);
    $article->save();

    $article->tags()->sync($randomTags);
});