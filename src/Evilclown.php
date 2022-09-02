<?php

namespace Tutu\Evilclown;

use function cli\line;
use function cli\prompt;

/**
 * Runs task Evil Clown
 *
 * @return void
 */
function evilClown(): void
{
    $doc = <<<DOC
    Это злой клоун!
    Он хочет, чтобы в смайликах не было больше одной скобки подряд.
    Давайте проверим, так ли это!
    DOC;

    line($doc);
    $text = getText();
    line(deletSmiles($text));
}

/**
 * Function receives a string in which to remove emoticons
 * @return string The line in which to remove emoticons
 */
function getText(): string
{
    $text = '';
    while (!(strripos($text, ')') || strripos($text, '('))) {
        $text = prompt('Введите фразу со смайликами в виде скобок');
    }
    return $text;
}

/**
 * Function receives a string in which to remove emoticons
 * @param string $text The line in which to remove emoticons
 * @return string The line with removed smilies
 */
function deletSmiles(string $text): string
{
    $result = '';
    $patterns = array('/(\))+/', '/(\()+/');
    $replacements = array(')', '(');
    $result = preg_replace($patterns, $replacements, $text);
    return $result;
}
