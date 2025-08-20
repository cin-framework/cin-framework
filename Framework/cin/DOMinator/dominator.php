<?php

declare(strict_types=1);

/**
 * CIN Framework DOMinator Core
 *
 * Main DOMinator component that orchestrates all framework functionality
 * including SEO, language management, assets, and HTML generation.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

require_once __DIR__ . '/dominator.formatter.php';
require_once __DIR__ . '/dominator.seo.php';
require_once __DIR__ . '/dominator.lang.php';
require_once __DIR__ . '/dominator.assets.php';
require_once __DIR__ . '/dominator.htmx.php';
require_once __DIR__ . '/dominator.html.php';

/**
 * Manages SEO configuration for a specific page.
 *
 * Initializes and configures SEO metadata for the specified page
 * using the framework's SEO management system.
 *
 * @param string $page The page identifier for SEO configuration
 *
 * @return bool True if SEO was configured successfully, false otherwise
 */
function dominator_seo(string $page): bool
{
    return manage_page_seo($page);
}

/**
 * Configures multi-language support for the current page.
 *
 * Sets up language management, processes language switching via GET parameters,
 * and initializes the language system for the specified languages.
 *
 * @param string ...$languages Variable number of language codes to support
 *
 * @return bool True if language system was configured successfully, false otherwise
 */
function dominator_lang(string ...$languages): bool
{
    if (empty($languages)) {
        cin_logs("No languages provided to dominator_lang", "dev");
        return false;
    }

    $page = basename($_SERVER['PHP_SELF'], '.php');
    
    if (!manage_page_languages($page, $languages)) {
        cin_logs("Failed to manage page languages for: {$page}", "system");
        return false;
    }
    
    require_once __DIR__ . '/dominator.lang.php';
    
    if (isset($_GET['lang']) && in_array($_GET['lang'], $languages)) {
        set_language_cookies($_GET['lang']);
    }
    
    global $dominator_supported_languages;
    $dominator_supported_languages = $languages;
    
    return true;
}

/**
 * Main DOMinator initialization function.
 *
 * Automatically configures SEO for the current page and generates
 * the basic HTML structure for the framework.
 *
 * @return void
 */
function dominator(): void
{
    $page = basename($_SERVER['PHP_SELF'], '.php');
    dominator_seo($page);
    generate_html_structure();
    smart_manage_page_files();
}
