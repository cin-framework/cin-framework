<?php

declare(strict_types=1);

/**
 * CIN Framework HTML Formatter
 *
 * Provides HTML content formatting and optimization functionality
 * for the CIN Framework DOMinator component.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

/**
 * Formats HTML content by removing empty lines and normalizing whitespace.
 *
 * Processes HTML content to remove unnecessary blank lines while preserving
 * the structure and readability of the markup.
 *
 * @param string $html       The HTML content to format
 * @param int    $indentSize The indentation size (currently unused)
 *
 * @return string The formatted HTML content
 */
function format_html(string $html, int $indentSize = 4): string
{
    $lines = explode("\n", $html);
    $result = '';

    foreach ($lines as $line) {
        $line = trim($line);
        if (!empty($line)) {
            $result .= $line . "\n";
        }
    }

    return trim($result);
}
