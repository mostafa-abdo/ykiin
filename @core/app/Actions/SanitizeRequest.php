<?php

namespace App\Actions;

class SanitizeRequest
{
    /**
     * Sanitize a string to remove harmful HTML and script tags
     */
    public static function sanitizeString($value): string
    {
        return htmlspecialchars(strip_tags($value));
    }

    /**
     * Sanitize a URL to ensure it’s a valid, safe URL
     */
    public static function sanitizeUrl($value): string
    {
        return filter_var($value, FILTER_SANITIZE_URL);
    }

    /**
     * Sanitize a string with specific allowed HTML tags
     */
    public static function sanitizeWithAllowedTags($value, array $allowedTags): string
    {
        return strip_tags($value, implode('', $allowedTags));
    }
}
