<?php

/*
 * Reading Time
 *
 * A simple plugin that estimates the reading
 * time for any text
 *
 * Sample Usage:
 *
 * <?php echo readingtime($page->text()) ?>
 *
 * Author: Roy Lodder <http://roylodder.com>
 * Contributor: Bastian Allgeier <http://getkirby.com>
 *
 */

/**
 * Get the reading time for a content
 *
 * @param $content
 *
 * @return string
 */
function reading_time($content)
{
    $options = [
        'minute'  => 'minute',
        'minutes' => 'minutes',
        'second'  => 'second',
        'seconds' => 'seconds',
        'format'  => '{minutesCount} {minutesLabel}, {secondsCount} {secondsLabel}',
    ];

    $words = str_word_count(strip_tags($content));
    $minutesCount = floor($words / 250);
    $secondsCount = floor($words % 250 / (250 / 60));
    $minutesLabel = '';
    $secondsLabel = '';

    if ($minutesCount > 0) {
        $minutesLabel = ($minutesCount <= 1) ? $options['minute'] : $options['minutes'];
    }

    if ($secondsCount > 0) {
        $secondsLabel = ($secondsCount <= 1) ? $options['second'] : $options['seconds'];
    }

    $replace = [
        'minutesCount' => $minutesCount,
        'minutesLabel' => $minutesLabel,
        'secondsCount' => $secondsCount,
        'secondsLabel' => $secondsLabel,
    ];

    $result = $options['format'];

    foreach ($replace as $key => $value) {
        $result = str_replace('{'.$key.'}', $value, $result);
    }

    $result = trim($result, ", 0");

    return $result;
}