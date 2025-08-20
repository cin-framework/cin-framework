<?php

declare(strict_types=1);

/**
 * CIN Framework Directory Management System
 *
 * Handles creation and validation of all required framework directories
 * including configuration, assets, logs, and language directories.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

/**
 * Ensures the main .cin directory exists in the project root.
 *
 * Creates the .cin directory with proper permissions if it doesn't exist.
 * This directory serves as the primary storage location for framework data.
 *
 * @return bool True if directory exists or was created successfully, false otherwise
 */
function ensure_cin_directory(): bool
{
    $cinFolder = ROOT_PATH . '/.cin';

    if (file_exists($cinFolder)) {
        return true;
    }

    if (!mkdir($cinFolder, 0755, true)) {
        cin_logs("Failed to create .cin directory", "folder");
        return false;
    }
    cin_logs("Successfully created .cin directory", "success");
    return true;
}

/**
 * Ensures the logs directory exists within the .cin folder.
 *
 * Creates the .cin/logs directory for storing framework log files
 * with proper permissions for write access.
 *
 * @return bool True if directory exists or was created successfully, false otherwise
 */
function ensure_logs_directory(): bool
{
    $logsFolder = ROOT_PATH . '/.cin/logs';

    if (file_exists($logsFolder)) {
        return true;
    }

    if (!mkdir($logsFolder, 0755, true)) {
        cin_logs("Failed to create logs directory", "folder");
        return false;
    }
    cin_logs("Successfully created logs directory", "success");
    return true;
}

/**
 * Ensures the SEO directory exists within the .cin folder.
 *
 * Creates the .cin/seo directory for storing SEO configuration files
 * and metadata for each page.
 *
 * @return bool True if directory exists or was created successfully, false otherwise
 */
function ensure_seo_directory(): bool
{
    $seoFolder = ROOT_PATH . '/.cin/seo';

    if (file_exists($seoFolder)) {
        return true;
    }

    if (!mkdir($seoFolder, 0755, true)) {
        cin_logs("Failed to create SEO directory", "folder");
        return false;
    }
    cin_logs("Successfully created SEO directory", "success");
    return true;
}

/**
 * Ensures the language directory exists within the .cin folder.
 *
 * Creates the .cin/lang directory structure for storing translation files
 * and language-specific content.
 *
 * @return bool True if directory exists or was created successfully, false otherwise
 */
function ensure_lang_directory(): bool
{
    $langFolder = ROOT_PATH . '/.cin/lang';

    if (file_exists($langFolder)) {
        return true;
    }

    if (!mkdir($langFolder, 0755, true)) {
        cin_logs("Failed to create language directory", "folder");
        return false;
    }
    cin_logs("Successfully created language directory", "success");
    return true;
}

/**
 * Ensures the CSS directory exists within the .cin folder.
 *
 * Creates the .cin/css directory for storing source CSS files
 * before processing and compilation.
 *
 * @return bool True if directory exists or was created successfully, false otherwise
 */
function ensure_css_directory(): bool
{
    $cssFolder = ROOT_PATH . '/.cin/css';

    if (file_exists($cssFolder)) {
        return true;
    }

    if (!mkdir($cssFolder, 0755, true)) {
        cin_logs("Failed to create CSS directory", "folder");
        return false;
    }
    cin_logs("Successfully created CSS directory", "success");
    return true;
}

/**
 * Ensures the JavaScript directory exists within the .cin folder.
 *
 * Creates the .cin/js directory for storing source JavaScript files
 * before processing and compilation.
 *
 * @return bool True if directory exists or was created successfully, false otherwise
 */
function ensure_js_directory(): bool
{
    $jsFolder = ROOT_PATH . '/.cin/js';

    if (file_exists($jsFolder)) {
        return true;
    }

    if (!mkdir($jsFolder, 0755, true)) {
        cin_logs("Failed to create JavaScript directory", "folder");
        return false;
    }
    cin_logs("Successfully created JavaScript directory", "success");
    return true;
}

/**
 * Ensures the assets directory exists in the project root.
 *
 * Creates the cin.assets directory for storing compiled CSS, JavaScript,
 * and other processed assets for public access.
 *
 * @return bool True if directory exists or was created successfully, false otherwise
 */
function ensure_assets_directory(): bool
{
    $assetsFolder = ROOT_PATH . '/cin.assets';

    if (file_exists($assetsFolder)) {
        return true;
    }

    if (!mkdir($assetsFolder, 0755, true)) {
        cin_logs("Failed to create cin.assets directory", "folder");
        return false;
    }
    cin_logs("Successfully created cin.assets directory", "success");
    return true;
}

/**
 * Ensures the public directory exists in the project root.
 *
 * Creates the public directory for storing HTMX templates, static files,
 * and other publicly accessible content.
 *
 * @return bool True if directory exists or was created successfully, false otherwise
 */
function ensure_public_directory(): bool
{
    $publicFolder = ROOT_PATH . '/public';

    if (file_exists($publicFolder)) {
        return true;
    }

    if (!mkdir($publicFolder, 0755, true)) {
        cin_logs("Failed to create public directory", "folder");
        return false;
    }
    cin_logs("Successfully created public directory", "success");
    return true;
}
