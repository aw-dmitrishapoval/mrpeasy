<?php

namespace Core\Helper;

/**
 * XSS escaping helper
 */
class Template
{
    public static function escape($text)
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}