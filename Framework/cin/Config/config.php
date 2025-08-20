<?php

declare(strict_types=1);

/**
 * CIN Framework Core Configuration
 *
 * Main configuration bootstrap that initializes the complete framework system
 * and manages all required directories and system integrity validation.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

require_once __DIR__ . '/config.folder.php';
require_once __DIR__ . '/config.file.php';

/**
 * Initializes the complete CIN Framework system.
 *
 * Creates all required directories and validates system integrity.
 * This function must be called before any framework operations.
 *
 * @return bool True if all directories were created successfully, false otherwise
 */
function initialize_cin_system(): bool
{
    $requiredDirectories = [
        'cin' => ensure_cin_directory(),
        'lang' => ensure_lang_directory(),
        'logs' => ensure_logs_directory(),
        'seo' => ensure_seo_directory(),
        'css' => ensure_css_directory(),
        'js' => ensure_js_directory(),
        'assets' => ensure_assets_directory(),
        'public' => ensure_public_directory()
    ];

    foreach ($requiredDirectories as $directory => $result) {
        if (!$result) {
            cin_logs("Failed to initialize {$directory} directory during system setup", "system");
            return false;
        }
    }

    return true;
}

/**
 * Manages SEO configuration for a specific page.
 *
 * Ensures the SEO directory exists and creates a default SEO configuration
 * file for the specified page if it doesn't already exist.
 *
 * @param string $page The page name to manage SEO for
 *
 * @return bool True if SEO file exists or was created successfully, false otherwise
 */
function manage_page_seo(string $page): bool
{
    if (!ensure_seo_directory()) {
        cin_logs("Failed to ensure SEO directory exists for page: {$page}", "system");
        return false;
    }

    $seoFile = ROOT_PATH . "/.cin/seo/{$page}.json";

    if (verify_file_exists($seoFile)) {
        return true;
    }

    return create_seo_file($page, $seoFile);
}

/**
 * Manages language files for a specific page.
 *
 * Creates language directories and translation files for each specified
 * language if they don't already exist.
 *
 * @param string $page      The page name to manage languages for
 * @param array  $languages Array of language codes to create files for
 *
 * @return bool True if all language files exist or were created successfully, false otherwise
 */
function manage_page_languages(string $page, array $languages): bool
{
    if (!ensure_lang_directory()) {
        cin_logs("Failed to ensure language directory exists for page: {$page}", "system");
        return false;
    }

    foreach ($languages as $language) {
        $langDir = ROOT_PATH . "/.cin/lang/{$language}";
        
        if (!file_exists($langDir)) {
            if (!mkdir($langDir, 0755, true)) {
                cin_logs("Failed to create language directory for {$language}", "system");
                continue;
            }
        }

        $langFile = $langDir . "/{$page}.json";
        
        if (!verify_file_exists($langFile)) {
            if (!create_language_file($page, $language, $langFile)) {
                cin_logs("Failed to create language file for page: {$page}, language: {$language}", "file");
                return false;
            }
        }
    }

    return true;
}

