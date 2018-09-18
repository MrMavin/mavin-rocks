<?php

function parsedown($text, $view = false)
{
    if ($view) {
        $path = str_replace('.', '/', $text).'.md';
        $text = file_get_contents(resource_path("views/{$path}"));
    }

    $parser = app(\ParsedownExtra::class);

    return $parser->text($text);
}