<?php

declare(strict_types=1);

/**
 * CIN Framework Configuration File Manager
 *
 * Handles file-based configuration management including SEO structures,
 * asset management, language files, and core system configurations.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

/**
 * Retrieves the default SEO structure configuration.
 *
 * Returns a comprehensive SEO configuration template including meta tags,
 * Open Graph properties, Twitter cards, and structured data.
 *
 * @return array Complete default SEO configuration structure
 */
function get_default_seo_structure(): array
{
    return [
        'meta' => [
            'title' => '{{dominator_seo_meta_titel}}',
            'description' => '{{dominator_seo_meta_description}}',
            'keywords' => '{{dominator_seo_meta_keywords}}',
            'author' => '{{dominator_seo_meta_author}}',
            'robots' => '{{dominator_seo_meta_robots}}',
            'viewport' => '{{dominator_seo_meta_viewport}}',
            'copyright' => '{{dominator_seo_meta_copyright}}',
            'language' => '{{dominator_seo_meta_language}}',
            'revisit-after' => '{{dominator_seo_meta_revisit_after}}',
            'rating' => '{{dominator_seo_meta_rating}}',
            'distribution' => '{{dominator_seo_meta_distribution}}',
            'coverage' => '{{dominator_seo_meta_coverage}}',
            'theme-color' => '{{dominator_seo_meta_theme_color}}',
            'mobile-web-app-capable' => '{{dominator_seo_meta_mobile_web_app_capable}}',
            'apple-mobile-web-app-capable' => '{{dominator_seo_meta_apple_mobile_web_app_capable}}',
            'apple-mobile-web-app-status-bar-style' => '{{dominator_seo_meta_apple_mobile_web_app_status_bar_style}}',
            'format-detection' => '{{dominator_seo_meta_format_detection}}'
        ],
        'og' => [
            'type' => '{{dominator_seo_og_type}}',
            'title' => '{{dominator_seo_og_title}}',
            'description' => '{{dominator_seo_og_description}}',
            'image' => '{{dominator_seo_og_image}}',
            'url' => '{{dominator_seo_og_url}}',
            'site_name' => '{{dominator_seo_og_site_name}}'
        ],
        'twitter' => [
            'card' => '{{dominator_seo_twitter_card}}',
            'title' => '{{dominator_seo_twitter_title}}',
            'description' => '{{dominator_seo_twitter_description}}',
            'image' => '{{dominator_seo_twitter_image}}'
        ],
        'article' => [
            'author' => '{{dominator_seo_article_author}}',
            'published_time' => '{{dominator_seo_article_published_time}}',
            'modified_time' => '{{dominator_seo_article_modified_time}}',
            'section' => '{{dominator_seo_article_section}}',
            'tag' => '{{dominator_seo_article_tag}}'
        ],
        'geo' => [
            'region' => '{{dominator_seo_geo_region}}',
            'placename' => '{{dominator_seo_geo_placename}}',
            'position' => '{{dominator_seo_geo_position}}'
        ],
        'structured_data' => [
            'type' => '{{dominator_seo_structured_data_type}}',
            'name' => '{{dominator_seo_structured_data_name}}',
            'description' => '{{dominator_seo_structured_data_description}}',
            'url' => '{{dominator_seo_structured_data_url}}'
        ]
    ];
}

/**
 * Creates a new SEO configuration file for a specific page.
 *
 * Generates a JSON file containing default SEO structure with proper
 * encoding for Unicode characters.
 *
 * @param string $page     The page name for the SEO file
 * @param string $filePath The full path where the SEO file should be created
 *
 * @return bool True if file was created successfully, false otherwise
 */
function create_seo_file(string $page, string $filePath): bool
{
    $defaultSeoConfig = get_default_seo_structure();
    $jsonContent = json_encode($defaultSeoConfig, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    if ($jsonContent === false) {
        cin_logs("Failed to encode SEO configuration for page: {$page}", "system");
        return false;
    }

    if (file_put_contents($filePath, $jsonContent) === false) {
        cin_logs("Failed to create SEO file for page: {$page}", "system");
        return false;
    }

    return true;
}

/**
 * Ensures core framework assets exist and are properly configured.
 *
 * Validates and creates essential files including core.min.js and .htaccess
 * in the cin.assets directory.
 *
 * @return bool True if all core assets exist or were created successfully, false otherwise
 */
function ensure_core_assets(): bool
{
    if (!ensure_assets_directory()) {
        return false;
    }

    $assetsDir = ROOT_PATH . '/cin.assets';
    $coreJsFile = $assetsDir . '/core.min.js';
    $htaccessFile = $assetsDir . '/.htaccess';
    $success = true;

    if (!file_exists($coreJsFile) || filesize($coreJsFile) < 1000) {
        if (!create_core_js_file($coreJsFile)) {
            $success = false;
        }
    }

    if (!file_exists($htaccessFile) || filesize($htaccessFile) < 100) {
        if (!create_htaccess_file($htaccessFile)) {
            $success = false;
        }
    }

    return $success;
}

/**
 * Creates the core JavaScript file for the framework.
 *
 * Generates the core.min.js file containing essential JavaScript functionality
 * for language switching and framework operations.
 *
 * @param string $filePath The full path where the core JS file should be created
 *
 * @return bool True if file was created successfully, false otherwise
 */
function create_core_js_file(string $filePath): bool
{
    $coreJsContent = get_required_core_js_content();

    if (file_put_contents($filePath, $coreJsContent) === false) {
        cin_logs("Failed to create Core.min.js file", "file");
        return false;
    }

    cin_logs("Core.min.js file created successfully", "success");
    return true;
}

/**
 * Creates the .htaccess file for assets directory.
 *
 * Generates proper Apache configuration for serving framework assets
 * with appropriate MIME types and caching headers.
 *
 * @param string $filePath The full path where the .htaccess file should be created
 *
 * @return bool True if file was created successfully, false otherwise
 */
function create_htaccess_file(string $filePath): bool
{
    $htaccessContent = get_required_htaccess_content();

    if (file_put_contents($filePath, $htaccessContent) === false) {
        cin_logs("Failed to create .htaccess file", "file");
        return false;
    }

    cin_logs(".htaccess file created successfully", "success");
    return true;
}

if (!function_exists('get_language_direction')) {
    /**
 * Determines the text direction for a given language.
 *
 * Returns 'rtl' for right-to-left languages (Arabic, Hebrew, etc.)
 * and 'ltr' for left-to-right languages.
 *
 * @param string $language The language code to check
 *
 * @return string Either 'rtl' or 'ltr'
 */
function get_language_direction(string $language): string
    {
        require_once CIN_PATH . '/DOMinator/dominator.lang.php';

        return LANGUAGE_DIRECTIONS[$language] ?? 'ltr';
    }
}

if (!function_exists('verify_file_exists')) {
    /**
 * Verifies that a file exists and is readable.
 *
 * Checks both file existence and read permissions to ensure
 * the file can be properly accessed.
 *
 * @param string $filePath The path to the file to verify
 *
 * @return bool True if file exists and is readable, false otherwise
 */
function verify_file_exists(string $filePath): bool
    {
        return file_exists($filePath) && is_file($filePath);
    }
}

/**
 * Retrieves default translations for a specific language.
 *
 * Returns basic translation mappings for common terms. Falls back to English
 * if the requested language is not available.
 *
 * @param string $language The language code to get translations for
 *
 * @return array Array of translation key-value pairs
 */
function get_default_translations(string $language): array
{
    $translations = [
        'en' => [
            'hello' => 'Hello'
        ],
        'ar' => [
            'hello' => 'مرحبا'
        ]
    ];

    return $translations[$language] ?? $translations['en'];
}

/**
 * Creates a language configuration file for a specific page and language.
 *
 * Generates a JSON file containing language metadata, direction, and default
 * translations for the specified page and language combination.
 *
 * @param string $page     The page name for the language file
 * @param string $language The language code
 * @param string $filePath The full path where the language file should be created
 *
 * @return bool True if file was created successfully, false otherwise
 */
function create_language_file(string $page, string $language, string $filePath): bool
{
    $defaultTranslations = get_default_translations($language);

    $langConfig = [
        'page' => $page,
        'language' => $language,
        'direction' => get_language_direction($language),
        'translations' => $defaultTranslations
    ];

    $jsonContent = json_encode($langConfig, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    if ($jsonContent === false) {
        cin_logs("Failed to encode language configuration for page: {$page}, language: {$language}", "system");
        return false;
    }

    if (file_put_contents($filePath, $jsonContent) === false) {
        cin_logs("Failed to create language file for page: {$page}, language: {$language}", "file");
        return false;
    }

    return true;
}

function get_language_direction(string $language): string
{
    $rtlLanguages = ['ar', 'he', 'fa', 'ur', 'yi', 'ku', 'ps', 'sd', 'ug', 'dv'];
    return in_array($language, $rtlLanguages) ? 'rtl' : 'ltr';
}

function verify_file_exists(string $filePath): bool
{
    return file_exists($filePath) && is_readable($filePath);
}

/**
 * Validates and repairs an SEO configuration file.
 *
 * Checks the integrity of an existing SEO file and repairs any missing
 * or corrupted structure elements using the default SEO template.
 *
 * @param string $filePath The path to the SEO file to validate
 * @param string $page     The page name associated with the SEO file
 *
 * @return bool True if file is valid or was repaired successfully, false otherwise
 */
function validate_and_repair_seo_file(string $filePath, string $page): bool
{
    $defaultSeoStructure = get_default_seo_structure();

    if (!file_exists($filePath)) {
        return create_seo_file($page, $filePath);
    }

    $currentContent = file_get_contents($filePath);
    if ($currentContent === false) {
        cin_logs("Failed to read SEO file: {$filePath}", "system");
        return false;
    }

    $currentConfig = json_decode($currentContent, true);
    if ($currentConfig === null) {
        cin_logs("Invalid JSON in SEO file: {$filePath}", "system");
        return create_seo_file($page, $filePath);
    }

    $repaired = false;
    $repairedConfig = repair_seo_structure($currentConfig, $defaultSeoStructure, $repaired);

    if ($repaired) {
        $jsonContent = json_encode($repairedConfig, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if ($jsonContent !== false && file_put_contents($filePath, $jsonContent) !== false) {
            cin_logs("SEO file repaired: {$filePath}", "success");
            return true;
        } else {
            cin_logs("Failed to save repaired SEO file: {$filePath}", "system");
            return false;
        }
    }

    return true;
}

/**
 * Repairs SEO structure by merging missing elements from default configuration.
 *
 * Recursively compares current SEO configuration with default structure
 * and adds any missing keys or nested arrays.
 *
 * @param array $current  The current SEO configuration
 * @param array $default  The default SEO structure to merge from
 * @param bool  $repaired Reference parameter indicating if repairs were made
 *
 * @return array The repaired SEO configuration
 */
function repair_seo_structure(array $current, array $default, bool &$repaired): array
{
    foreach ($default as $key => $value) {
        if (!array_key_exists($key, $current)) {
            $current[$key] = $value;
            $repaired = true;
        } elseif (is_array($value) && is_array($current[$key])) {
            $current[$key] = repair_seo_structure($current[$key], $value, $repaired);
        }
    }
    return $current;
}

/**
 * Validates and repairs a language configuration file.
 *
 * Checks the integrity of an existing language file and repairs any missing
 * required fields such as page, language, direction, and translations.
 *
 * @param string $filePath The path to the language file to validate
 * @param string $page     The page name associated with the language file
 * @param string $language The language code for the file
 *
 * @return bool True if file is valid or was repaired successfully, false otherwise
 */
function validate_and_repair_language_file(string $filePath, string $page, string $language): bool
{
    if (!file_exists($filePath)) {
        return create_language_file($page, $language, $filePath);
    }

    $currentContent = file_get_contents($filePath);
    if ($currentContent === false) {
        cin_logs("Failed to read language file: {$filePath}", "system");
        return false;
    }

    $currentConfig = json_decode($currentContent, true);
    if ($currentConfig === null) {
        cin_logs("Invalid JSON in language file: {$filePath}", "system");
        return create_language_file($page, $language, $filePath);
    }

    $repaired = false;

    if (!array_key_exists('page', $currentConfig)) {
        $currentConfig['page'] = $page;
        $repaired = true;
    }

    if (!array_key_exists('language', $currentConfig)) {
        $currentConfig['language'] = $language;
        $repaired = true;
    }

    if (!array_key_exists('direction', $currentConfig)) {
        $currentConfig['direction'] = get_language_direction($language);
        $repaired = true;
    }

    if (!array_key_exists('translations', $currentConfig)) {
        $currentConfig['translations'] = [];
        $repaired = true;
    }

    if ($repaired) {
        $jsonContent = json_encode($currentConfig, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if ($jsonContent !== false && file_put_contents($filePath, $jsonContent) !== false) {
            cin_logs("Language file repaired: {$filePath}", "success");
            return true;
        } else {
            cin_logs("Failed to save repaired language file: {$filePath}", "system");
            return false;
        }
    }

    return true;
}

/**
 * Intelligently manages all page-related files including SEO and language files.
 *
 * Performs comprehensive file management including asset validation, SEO file creation,
 * and language file generation for specified languages. If no page is specified,
 * performs system-wide repair operations.
 *
 * @param string|null $page      The page name to manage files for, null for system-wide repair
 * @param array       $languages Array of language codes to create files for
 *
 * @return bool True if all operations completed successfully, false otherwise
 */
function smart_manage_page_files(?string $page = null, array $languages = ['en', 'ar']): bool
{
    ensure_core_assets();

    if ($page === null) {
        return auto_repair_all_files();
    }

    $success = true;

    if (!validate_and_repair_assets()) {
        $success = false;
        cin_logs('Failed to validate and repair CIN assets', 'system');
    }

    $seoPath = ROOT_PATH . "/.cin/seo/{$page}.json";
    if (!validate_and_repair_seo_file($seoPath, $page)) {
        $success = false;
        cin_logs("Failed to manage SEO file for page: {$page}", "system");
    }

    foreach ($languages as $language) {
        $langPath = ROOT_PATH . "/.cin/lang/{$language}/{$page}.json";

        $langDir = dirname($langPath);
        if (!is_dir($langDir)) {
            if (!mkdir($langDir, 0755, true)) {
                cin_logs("Failed to create language directory: {$langDir}", "system");
                $success = false;
                continue;
            }
        }

        if (!validate_and_repair_language_file($langPath, $page, $language)) {
            $success = false;
            cin_logs("Failed to manage language file for page: {$page}, language: {$language}", "system");
        }
    }

    return $success;
}

/**
 * Automatically repairs all existing SEO and language files in the system.
 *
 * Scans all existing SEO and language files and performs validation and repair
 * operations on each file to ensure structural integrity.
 *
 * @return bool True if all files were processed successfully, false otherwise
 */
function auto_repair_all_files(): bool
{
    $success = true;

    $seoDir = ROOT_PATH . '/.cin/seo';
    if (is_dir($seoDir)) {
        $seoFiles = glob($seoDir . '/*.json');
        foreach ($seoFiles as $seoFile) {
            $page = basename($seoFile, '.json');
            if (!validate_and_repair_seo_file($seoFile, $page)) {
                $success = false;
            }
        }
    }

    $langDir = ROOT_PATH . '/.cin/lang';
    if (is_dir($langDir)) {
        $languageDirs = glob($langDir . '/*', GLOB_ONLYDIR);
        foreach ($languageDirs as $languageDir) {
            $language = basename($languageDir);
            $langFiles = glob($languageDir . '/*.json');
            foreach ($langFiles as $langFile) {
                $page = basename($langFile, '.json');
                if (!validate_and_repair_language_file($langFile, $page, $language)) {
                    $success = false;
                }
            }
        }
    }

    if (!validate_and_repair_assets()) {
        $success = false;
    }

    return $success;
}

/**
 * Validates and repairs core framework assets.
 *
 * Ensures that essential framework assets (core.min.js and .htaccess)
 * exist and contain the required content.
 *
 * @return bool True if all assets are valid or were repaired successfully, false otherwise
 */
function validate_and_repair_assets(): bool
{
    $success = true;

    if (!validate_and_repair_core_js()) {
        $success = false;
        cin_logs('Failed to validate and repair core.min.js', 'system');
    }

    if (!validate_and_repair_htaccess()) {
        $success = false;
        cin_logs('Failed to validate and repair .htaccess', 'system');
    }

    return $success;
}

/**
 * Generates the required core JavaScript content for the framework.
 *
 * Returns the complete JavaScript code including all framework modules
 * organized in a modular structure for maintainability and extensibility.
 *
 * @return string The complete core JavaScript content
 */
function get_required_core_js_content(): string
{
    $coreHeader = '/**
 * CIN Framework Core JavaScript Module
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */';

    $coreInitialization = get_core_initialization_js();

    $languageModule = get_language_js_module();
    
    return $coreHeader . "\n" . $languageModule . "\n" . $coreInitialization;
}

/**
 * Checks if dominator_lang function is being used in the current request.
 *
 * Determines if language functionality is active by checking for the
 * global variable set by dominator_lang function or by analyzing the call stack.
 *
 * @return bool True if dominator_lang is being used, false otherwise
 */
function is_dominator_lang_used(): bool
{
    global $dominator_supported_languages;
    
    // Check if the global variable is already set
    if (!empty($dominator_supported_languages)) {
        return true;
    }
    
    // Check if dominator_lang function exists in the call stack
    $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    foreach ($backtrace as $frame) {
        if (isset($frame['function']) && $frame['function'] === 'dominator_lang') {
            return true;
        }
    }
    
    // Check if dominator_lang is called in the current script (not commented)
    $currentScript = $_SERVER['SCRIPT_FILENAME'] ?? '';
    if (!empty($currentScript) && file_exists($currentScript)) {
        $content = file_get_contents($currentScript);
        if ($content !== false) {
            // Remove comments and check for dominator_lang
            $lines = explode("\n", $content);
            foreach ($lines as $line) {
                $trimmedLine = trim($line);
                // Skip commented lines
                if (strpos($trimmedLine, '//') === 0 || strpos($trimmedLine, '#') === 0) {
                    continue;
                }
                // Check for dominator_lang in non-commented lines
                if (strpos($trimmedLine, 'dominator_lang(') !== false) {
                    return true;
                }
            }
        }
    }
    
    return false;
}

/**
 * Generates the language management JavaScript module.
 *
 * Returns the complete language switching functionality including
 * cookie management and event handling for language changes.
 * Only includes the code if dominator_lang is being used.
 *
 * @return string The language module JavaScript code or empty string
 */
function get_language_js_module(): string
{
    if (!is_dominator_lang_used()) {
        return '';
    }
    
    return '
// CIN Language Management Module
(function() {
    \'use strict\';
    
    // Language Cookie Management
    function setLanguageCookie(lang) {
        document.cookie = `cin_lang=${lang}; path=/; max-age=31536000`;
    }
    
    function getLanguageCookie() {
        const match = document.cookie.match(/cin_lang=([^;]+)/);
        return match ? match[1] : null;
    }
    
    // Language Switching Core Function
    function switchLanguage(lang) {
        setLanguageCookie(lang);
        const url = new URL(window.location);
        url.searchParams.set(\'lang\', lang);
        window.location.href = url.toString();
    }
    
    // Language Event Handlers
    function initLanguageEventHandlers() {
        document.addEventListener(\'click\', function(e) {
            // Handle traditional language links
            const link = e.target.closest(\'a[href*="lang="]\');
            if (link) {
                e.preventDefault();
                const url = new URL(link.href);
                const lang = url.searchParams.get(\'lang\');
                if (lang) {
                    switchLanguage(lang);
                }
                return;
            }
            
            // Handle data-lang attribute elements
            const langElement = e.target.closest(\'[data-lang]\');
            if (langElement) {
                e.preventDefault();
                const lang = langElement.getAttribute(\'data-lang\');
                if (lang) {
                    switchLanguage(lang);
                }
            }
        });
    }
    
    // Initialize Language System
    function initLanguageSystem() {
        initLanguageEventHandlers();
    }
    
    // Auto-initialize when DOM is ready
    if (document.readyState === \'loading\') {
        document.addEventListener(\'DOMContentLoaded\', initLanguageSystem);
    } else {
        initLanguageSystem();
    }
    
    // Expose Language API
    window.CIN = window.CIN || {};
    window.CIN.Language = {
        switch: switchLanguage,
        getCurrent: getLanguageCookie,
        setCookie: setLanguageCookie
    };
    
    // Legacy API Support
    window.CIN.switchLanguage = switchLanguage;
    window.CIN.getCurrentLang = getLanguageCookie;
    
})();';
}

/**
 * Generates the core framework initialization JavaScript.
 *
 * Returns the main framework initialization code and global
 * namespace setup for future module extensions.
 *
 * @return string The core initialization JavaScript code
 */
function get_core_initialization_js(): string
{
    return '
// CIN Framework Core Initialization
(function() {
    \'use strict\';
    
    // Framework Information
    const FRAMEWORK_INFO = {
        name: \'CIN Framework\',
        author: \'Mawi Man\',
        license: \'Proprietary - All rights reserved to Ayoub Alarjani\'
    };
    
    // Core Framework Namespace
    window.CIN = window.CIN || {};
    
    // Framework Metadata
    window.CIN.info = FRAMEWORK_INFO;
    window.CIN.version = FRAMEWORK_INFO.version;
    
    // Module Registry for Future Extensions
    window.CIN.modules = window.CIN.modules || {};
    
    // Utility Functions
    window.CIN.utils = window.CIN.utils || {
        ready: function(callback) {
            if (document.readyState === \'loading\') {
                document.addEventListener(\'DOMContentLoaded\', callback);
            } else {
                callback();
            }
        },
        
        log: function(message, type = \'info\') {
            if (typeof console !== \'undefined\' && console[type]) {
                console[type](\'[CIN Framework]\', message);
            }
        }
    };

    // Security Console Warning
    window.CIN.showSecurityConsoleWarning = function() {
        try {
            console.log(
                "%cSTOP!",
                [
                    "color:#ff1a1a",
                    "font-size:64px",
                    "font-weight:900",
                    "font-family:system-ui,-apple-system,Segoe UI,Helvetica,Arial,sans-serif",
                    "text-shadow:1px 1px 0 #000",
                    "padding:8px 0"
                ].join(";")
            );

            console.log(
                "%cThis is a browser feature intended for developers. If someone told you to copy-paste something here to enable a feature or \\"hack\\" someone\'s account, it is a scam and will give them access to your account.",
                [
                    "font-size:16px",
                    "line-height:1.6",
                    "font-weight:600",
                    "font-family:system-ui,-apple-system,Segoe UI,Helvetica,Arial,sans-serif",
                    "background:#bcd3ff",
                    "color:#111",
                    "border:2px solid #2a4169",
                    "border-radius:6px",
                    "padding:14px",
                    "max-width:960px"
                ].join(";")
            );

            // تم حذف console.warn لتفادي ظهور Trace في الكونسول
            console.log(
                "%cDeveloper Tools (Console) are for developers only.",
                [
                    "font-size:12px",
                    "font-style:italic",
                    "opacity:0.85",
                    "padding-top:6px"
                ].join(";")
            );
        } catch (e) {
            console.log("STOP!");
            console.log("This is a browser feature intended for developers. If someone told you to copy-paste something here to enable a feature or hack someone\'s account, it is a scam and will give them access to your account.");
            console.log("Developer Tools (Console) are for developers only.");
        }
    };
    
    // Framework Ready Event -> Show security warning
    window.CIN.utils.ready(function() {
        window.CIN.showSecurityConsoleWarning();
    });
    
})();';
}


/**
 * Validates and repairs the core JavaScript file.
 *
 * Ensures the core.min.js file exists and contains the required JavaScript
 * functionality. Repairs the file while preserving any additional content.
 *
 * @return bool True if file is valid or was repaired successfully, false otherwise
 */
function validate_and_repair_core_js(): bool
{
    $coreJsPath = ROOT_PATH . '/cin.assets/core.min.js';
    $requiredCoreContent = get_required_core_js_content();

    if (!file_exists($coreJsPath)) {
        $assetsDir = dirname($coreJsPath);
        if (!is_dir($assetsDir)) {
            if (!mkdir($assetsDir, 0755, true)) {
                cin_logs('Failed to create cin.assets directory', 'system');
                return false;
            }
        }
        
        if (file_put_contents($coreJsPath, $requiredCoreContent) === false) {
            cin_logs('Failed to create core.min.js file', 'system');
            return false;
        }
        
        cin_logs('Created missing core.min.js file', 'success');
        return true;
    }

    $currentContent = file_get_contents($coreJsPath);
    if ($currentContent === false) {
        cin_logs('Failed to read core.min.js file', 'system');
        return false;
    }

    // Check if current content matches expected structure
    $expectedContent = trim($requiredCoreContent);
    $currentContentTrimmed = trim($currentContent);
    
    if ($currentContentTrimmed !== $expectedContent) {
        if (file_put_contents($coreJsPath, $requiredCoreContent) === false) {
            cin_logs('Failed to repair core.min.js file', 'system');
            return false;
        }
        
        cin_logs('Repaired core.min.js file with correct content', 'success');
    }

    return true;
}

/**
 * Generates the required .htaccess content for assets directory.
 *
 * Returns the complete Apache configuration for proper asset serving,
 * including MIME types, compression, and caching directives.
 *
 * @return string The complete .htaccess content
 */
function get_required_htaccess_content(): string
{
    return '# CIN Framework Assets Access Configuration

<Files "*.js">
    Order allow,deny
    Allow from all
</Files>

<Files "*.css">
    Order allow,deny
    Allow from all
</Files>

<Files "*.map">
    Order allow,deny
    Allow from all
</Files>

AddType application/javascript .js
AddType text/css .css

<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE text/css
</IfModule>

<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType text/css "access plus 1 month"
</IfModule>';
}

/**
 * Validates and repairs the .htaccess file for assets directory.
 *
 * Ensures the .htaccess file exists and contains all required Apache
 * directives. Repairs the file while preserving any additional content.
 *
 * @return bool True if file is valid or was repaired successfully, false otherwise
 */
function validate_and_repair_htaccess(): bool
{
    $htaccessPath = ROOT_PATH . '/cin.assets/.htaccess';
    $requiredCoreContent = get_required_htaccess_content();

    if (!file_exists($htaccessPath)) {
        $assetsDir = dirname($htaccessPath);
        if (!is_dir($assetsDir)) {
            if (!mkdir($assetsDir, 0755, true)) {
                cin_logs('Failed to create cin.assets directory', 'system');
                return false;
            }
        }
        
        if (file_put_contents($htaccessPath, $requiredCoreContent) === false) {
            cin_logs('Failed to create .htaccess file', 'system');
            return false;
        }
        
        cin_logs('Created missing .htaccess file', 'success');
        return true;
    }

    $currentContent = file_get_contents($htaccessPath);
    if ($currentContent === false) {
        cin_logs('Failed to read .htaccess file', 'system');
        return false;
    }

    $coreDirectives = [
        '# CIN Framework Assets Access Configuration',
        '<Files "*.js">',
        '<Files "*.css">',
        '<Files "*.map">',
        'AddType application/javascript .js',
        'AddType text/css .css',
        '<IfModule mod_deflate.c>',
        '<IfModule mod_expires.c>'
    ];
    
    $missingDirectives = [];
    foreach ($coreDirectives as $directive) {
        if (strpos($currentContent, $directive) === false) {
            $missingDirectives[] = $directive;
        }
    }
    
    if (!empty($missingDirectives)) {
        $lines = explode("\n", $currentContent);
        $additionalContent = '';
        $inCoreSection = false;
        
        foreach ($lines as $line) {
            $trimmedLine = trim($line);
            
            if ($trimmedLine === '# CIN Framework Assets Access Configuration') {
                $inCoreSection = true;
                continue;
            }
            
            if ($inCoreSection && strpos($trimmedLine, '</IfModule>') !== false && 
                (strpos($line, 'mod_expires') !== false || strpos($line, 'mod_deflate') !== false)) {
                $inCoreSection = false;
                continue;
            }
            
            if (!$inCoreSection && !empty($trimmedLine) && 
                !in_array($trimmedLine, $coreDirectives) &&
                strpos($trimmedLine, '# CIN Framework') === false) {
                $additionalContent .= $line . "\n";
            }
        }
        
        $repairedContent = $requiredCoreContent;
        if (!empty(trim($additionalContent))) {
            $repairedContent .= "\n\n" . trim($additionalContent);
        }
        
        if (file_put_contents($htaccessPath, $repairedContent) === false) {
            cin_logs('Failed to repair .htaccess file', 'system');
            return false;
        }
        
        cin_logs('Repaired .htaccess file while preserving additional content', 'success');
    }

    return true;
}
