<?php

declare(strict_types=1);

/**
 * CIN Framework DOMinator Language Manager
 *
 * This file implements the language management functionality for the DOMinator component,
 * handling multi-language support, translation files, and language direction management.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

/**
 * Language direction database.
 *
 * Contains language codes and their corresponding text directions.
 *
 * @var array<string, string>
 */
const LANGUAGE_DIRECTIONS = [
    'ar' => 'rtl',
    'he' => 'rtl',
    'fa' => 'rtl',
    'ur' => 'rtl',
    'yi' => 'rtl',
    'ku' => 'rtl',
    'ps' => 'rtl',
    'sd' => 'rtl',
    'ug' => 'rtl',
    'dv' => 'rtl'
];

/**
 * Language management functionality has been moved to the centralized
 * configuration system in /Config/config.php and /Config/config.file.php
 *
 * This file now contains only helper functions for language operations.
 */

/**
 * Sets language cookie only. Direction is determined automatically by PHP.
 *
 * @param string $language The language code to set.
 * @return void
 */
function set_language_cookies(string $language): void
{
    setcookie('cin_lang', $language, time() + (86400 * 365), '/');
}

/**
 * Handles language switching from URL parameters.
 *
 * @param array $supportedLanguages Array of supported language codes.
 * @return void
 */
function handle_language_switch(array $supportedLanguages): void
{
    if (isset($_GET['lang']) && in_array($_GET['lang'], $supportedLanguages)) {
        set_language_cookies($_GET['lang']);
        
        // Remove lang parameter from URL and redirect
        $url = $_SERVER['REQUEST_URI'];
        $parsedUrl = parse_url($url);
        
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
            unset($queryParams['lang']);
            
            $newQuery = http_build_query($queryParams);
            $newUrl = $parsedUrl['path'] . ($newQuery ? '?' . $newQuery : '');
        } else {
            $newUrl = $parsedUrl['path'];
        }
        
        header('Location: ' . $newUrl);
        exit;
    }
}

/**
 * Gets the current language from cookies or defaults to 'en'.
 *
 * @return string The current language code.
 */
function dominator_get_lang(): string
{
    return $_COOKIE['cin_lang'] ?? 'en';
}

/**
 * Gets the current language from cookies or defaults to 'en'.
 *
 * @deprecated Use dominator_get_lang() instead.
 * @return string The current language code.
 */
function get_current_language(): string
{
    return dominator_get_lang();
}

/**
 * Gets the current text direction based on current language.
 *
 * @return string The current text direction ('rtl' or 'ltr').
 */
function dominator_get_dir(): string
{
    $currentLang = dominator_get_lang();
    return get_language_direction($currentLang);
}

/**
 * Gets the current text direction from cookies or language database.
 *
 * @deprecated Use dominator_get_dir() instead.
 * @return string The current text direction ('rtl' or 'ltr').
 */
function get_current_direction(): string
{
    return dominator_get_dir();
}

/**
 * Loads translations for a specific page and language.
 *
 * @param string $page The page identifier.
 * @param string $language The language code.
 * @return array The translations array.
 */
function load_translations(string $page, string $language): array
{
    $langFile = ROOT_PATH . "/.cin/lang/{$language}/{$page}.json";
    
    if (!file_exists($langFile)) {
        return [];
    }
    
    $langConfig = json_decode(file_get_contents($langFile), true);
    if (!$langConfig || !isset($langConfig['translations'])) {
        return [];
    }
    
    return $langConfig['translations'];
}

/**
 * Gets the custom direction for a language if set.
 *
 * @param string $page The page identifier.
 * @param string $language The language code.
 * @return string|null The custom direction or null if not set.
 */
function get_custom_direction(string $page, string $language): ?string
{
    $langFile = ROOT_PATH . "/.cin/lang/{$language}/{$page}.json";
    
    if (!file_exists($langFile)) {
        return null;
    }
    
    $langConfig = json_decode(file_get_contents($langFile), true);
    return $langConfig['custom_direction'] ?? null;
}



/**
 * Processes translation placeholders in content.
 *
 * @param string $content The content containing translation placeholders.
 * @param string $page The page identifier.
 * @param string $language The language code.
 * @return string The content with translations applied.
 */
function process_translations(string $content, string $page, string $language): string
{
    $translations = load_translations($page, $language);
    
    if (empty($translations)) {
        return $content;
    }
    
    return preg_replace_callback(
        '/--tr\*([a-zA-Z0-9_]+)--/',
        function ($matches) use ($translations) {
            $key = $matches[1];
            return $translations[$key] ?? $matches[0];
        },
        $content
    );
}