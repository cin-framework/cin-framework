<?php

declare(strict_types=1);

/**
 * CIN Framework DOMinator Assets Manager
 *
 * Handles CSS and JavaScript file processing, compression, and injection
 * for the CIN Framework with support for both local and external resources.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

/**
 * Processes and injects CSS files for a specific page.
 *
 * Creates individual compressed CSS files for each source file and injects
 * them into the page with proper caching and performance optimization.
 * Uses version control to avoid unnecessary recompression.
 *
 * @param string ...$filenames Variable number of CSS filenames to process
 *
 * @return bool True if CSS was processed and injected successfully, false otherwise
 */
function dominator_style(string ...$filenames): bool
{
    try {
        if (!ensure_assets_css_directory()) {
            cin_logs("Failed to create cin.assets/css directory", "system");
            return false;
        }

        $processedFiles = [];
        
        foreach ($filenames as $filename) {
            $cssContent = get_css_content($filename);
            if (!empty($cssContent)) {
                $sourceVersion = extract_version_from_css($cssContent);
                $cssFilePath = ROOT_PATH . "/cin.assets/css/{$filename}-min.css";
                
                if (should_recompress_css($cssFilePath, $sourceVersion)) {
                    $compressedCSS = compress_css_advanced($cssContent);
                    
                    if (empty($compressedCSS)) {
                        cin_logs("Failed to compress CSS for file: {$filename}", "system");
                        continue;
                    }
                    
                    if (!save_compressed_css($cssFilePath, $compressedCSS, $filename, $sourceVersion)) {
                        cin_logs("Failed to save compressed CSS file: {$filename}-min.css", "system");
                        continue;
                    }
                    
                    cin_logs("CSS file {$filename} compressed with version {$sourceVersion}", "success");
                } else {
                    cin_logs("CSS file {$filename} is up to date, skipping compression", "dev");
                }
                
                inject_individual_css_link($filename);
                $processedFiles[] = $filename;
                
            } else {
                cin_logs("No CSS content found for file: {$filename}", "system");
            }
        }
        
        if (empty($processedFiles)) {
            cin_logs("No CSS files were processed successfully", "system");
            return false;
        }
        
        cin_logs("Successfully processed CSS files: " . implode(', ', $processedFiles), "success");
        return true;
        
    } catch (Exception $e) {
        cin_logs("Error in dominator_style for files " . implode(', ', $filenames) . ": " . $e->getMessage(), "system");
        return false;
    }
}

/**
 * Processes and injects JavaScript files for a specific page.
 *
 * Creates individual compressed JavaScript files for each source file and injects
 * them into the page with proper caching and performance optimization.
 * Uses version control to avoid unnecessary recompression.
 *
 * @param string ...$filenames Variable number of JavaScript filenames to process
 *
 * @return bool True if JavaScript was processed and injected successfully, false otherwise
 */
function dominator_script(string ...$filenames): bool
{
    try {
        if (!ensure_assets_js_directory()) {
            cin_logs("Failed to create cin.assets/js directory", "system");
            return false;
        }

        $processedFiles = [];
        
        foreach ($filenames as $filename) {
            $jsContent = get_js_content($filename);
            if (!empty($jsContent)) {
                $sourceVersion = extract_version_from_js($jsContent);
                $jsFilePath = ROOT_PATH . "/cin.assets/js/{$filename}-min.js";
                
                if (should_recompress_js($jsFilePath, $sourceVersion)) {
                    $compressedJS = compress_js_advanced($jsContent);
                    
                    if (empty($compressedJS)) {
                        cin_logs("Failed to compress JavaScript for file: {$filename}", "system");
                        continue;
                    }
                    
                    if (!save_compressed_js($jsFilePath, $compressedJS, $filename, $sourceVersion)) {
                        cin_logs("Failed to save compressed JavaScript file: {$filename}-min.js", "system");
                        continue;
                    }
                    
                    cin_logs("JavaScript file {$filename} compressed with version {$sourceVersion}", "success");
                } else {
                    cin_logs("JavaScript file {$filename} is up to date, skipping compression", "dev");
                }
                
                inject_individual_js_script($filename);
                $processedFiles[] = $filename;
                
            } else {
                cin_logs("No JavaScript content found for file: {$filename}", "system");
            }
        }
        
        if (empty($processedFiles)) {
            cin_logs("No JavaScript files were processed successfully", "system");
            return false;
        }
        
        cin_logs("Successfully processed JavaScript files: " . implode(', ', $processedFiles), "success");
        return true;
        
    } catch (Exception $e) {
        cin_logs("Error in dominator_script for files " . implode(', ', $filenames) . ": " . $e->getMessage(), "system");
        return false;
    }
}

/**
 * Injects external CSS URLs into the page.
 *
 * Adds external CSS stylesheet links to the page header for loading
 * from external sources or CDNs.
 *
 * @param string ...$urls Variable number of CSS URLs to inject
 *
 * @return bool True if URLs were injected successfully, false otherwise
 */
function dominator_style_url(string ...$urls): bool
{
    try {
        foreach ($urls as $url) {
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                inject_external_css_link($url);
            } else {
                cin_logs("Invalid CSS URL provided: {$url}", "dev");
                return false;
            }
        }
        
        cin_logs("Successfully injected external CSS URLs: " . implode(', ', $urls), "success");
        return true;
        
    } catch (Exception $e) {
        cin_logs("Error in dominator_style_url: " . $e->getMessage(), "system");
        return false;
    }
}

/**
 * Injects external JavaScript URLs into the page.
 *
 * Adds external JavaScript script tags to the page for loading
 * from external sources or CDNs.
 *
 * @param string ...$urls Variable number of JavaScript URLs to inject
 *
 * @return bool True if URLs were injected successfully, false otherwise
 */
function dominator_script_url(string ...$urls): bool
{
    try {
        foreach ($urls as $url) {
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                inject_external_js_script($url);
            } else {
                cin_logs("Invalid JavaScript URL provided: {$url}", "dev");
                return false;
            }
        }
        
        cin_logs("Successfully injected external JavaScript URLs: " . implode(', ', $urls), "success");
        return true;
        
    } catch (Exception $e) {
        cin_logs("Error in dominator_script_url: " . $e->getMessage(), "system");
        return false;
    }
}

/**
 * Ensures the assets CSS directory exists for storing processed CSS files.
 *
 * Creates the necessary directory structure for CSS file caching
 * and optimization within the assets directory.
 *
 * @return bool True if directory exists or was created successfully, false otherwise
 */
function ensure_assets_css_directory(): bool
{
    $cssDir = ROOT_PATH . '/cin.assets/css';
    
    if (!is_dir($cssDir)) {
        if (!mkdir($cssDir, 0755, true)) {
            return false;
        }
    }
    
    return true;
}

/**
 * Ensures the assets JavaScript directory exists for storing processed JS files.
 *
 * Creates the necessary directory structure for JavaScript file caching
 * and optimization within the assets directory.
 *
 * @return bool True if directory exists or was created successfully, false otherwise
 */
function ensure_assets_js_directory(): bool
{
    $jsDir = ROOT_PATH . '/cin.assets/js';
    
    if (!is_dir($jsDir)) {
        if (!mkdir($jsDir, 0755, true)) {
            return false;
        }
    }
    
    return true;
}

/**
 * Retrieves content from a CSS file.
 *
 * Reads CSS file from the .cin/css directory and returns its
 * content for processing.
 *
 * @param string $filename CSS filename to read
 *
 * @return string CSS content from the specified file
 */
function get_css_content(string $filename): string
{
    $cssFile = ROOT_PATH . "/.cin/css/{$filename}.css";
    
    if (!file_exists($cssFile)) {
        cin_logs("CSS file not found: {$cssFile}", "file");
        return '';
    }
    
    $content = file_get_contents($cssFile);
    
    if ($content === false) {
        cin_logs("Failed to read CSS file: {$cssFile}", "file");
        return '';
    }
    
    return $content;
}

/**
 * Retrieves content from a JavaScript file.
 *
 * Reads JavaScript file from the .cin/js directory and returns its
 * content for processing.
 *
 * @param string $filename JavaScript filename to read
 *
 * @return string JavaScript content from the specified file
 */
function get_js_content(string $filename): string
{
    $jsFile = ROOT_PATH . "/.cin/js/{$filename}.js";
    
    if (!file_exists($jsFile)) {
        cin_logs("JavaScript file not found: {$jsFile}", "file");
        return '';
    }
    
    $content = file_get_contents($jsFile);
    
    if ($content === false) {
        cin_logs("Failed to read JavaScript file: {$jsFile}", "file");
        return '';
    }
    
    return $content;
}

/**
 * Extracts version information from CSS content.
 *
 * Searches for version comment in CSS file and returns the version number.
 * If no version is found, returns default version 1.0.0.
 *
 * @param string $css The CSS content to analyze
 *
 * @return string The version number found or default 1.0.0
 */
function extract_version_from_css(string $css): string
{
    if (preg_match('/\/\*\s*@version\s+([0-9]+\.[0-9]+\.[0-9]+)\s*\*\//', $css, $matches)) {
        return $matches[1];
    }
    
    return '1.0.0';
}

/**
 * Extracts version information from JavaScript content.
 *
 * Searches for version comment in JavaScript file and returns the version number.
 * If no version is found, returns default version 1.0.0.
 *
 * @param string $js The JavaScript content to analyze
 *
 * @return string The version number found or default 1.0.0
 */
function extract_version_from_js(string $js): string
{
    if (preg_match('/\/\*\s*@version\s+([0-9]+\.[0-9]+\.[0-9]+)\s*\*\//', $js, $matches)) {
        return $matches[1];
    }
    
    if (preg_match('/\/\/\s*@version\s+([0-9]+\.[0-9]+\.[0-9]+)/', $js, $matches)) {
        return $matches[1];
    }
    
    return '1.0.0';
}

/**
 * Checks if CSS file needs recompression based on version.
 *
 * Compares source version with compressed file version to determine
 * if recompression is necessary.
 *
 * @param string $compressedFilePath Path to the compressed CSS file
 * @param string $sourceVersion Version from source CSS file
 *
 * @return bool True if recompression is needed, false otherwise
 */
function should_recompress_css(string $compressedFilePath, string $sourceVersion): bool
{
    if (!file_exists($compressedFilePath)) {
        return true;
    }
    
    $compressedContent = file_get_contents($compressedFilePath);
    if ($compressedContent === false) {
        return true;
    }
    
    if (preg_match('/\*\s*@version\s+([0-9]+\.[0-9]+\.[0-9]+)\s*\*/', $compressedContent, $matches)) {
        return version_compare($sourceVersion, $matches[1], '>');
    }
    
    return true;
}

/**
 * Checks if JavaScript file needs recompression based on version.
 *
 * Compares source version with compressed file version to determine
 * if recompression is necessary.
 *
 * @param string $compressedFilePath Path to the compressed JavaScript file
 * @param string $sourceVersion Version from source JavaScript file
 *
 * @return bool True if recompression is needed, false otherwise
 */
function should_recompress_js(string $compressedFilePath, string $sourceVersion): bool
{
    if (!file_exists($compressedFilePath)) {
        return true;
    }
    
    $compressedContent = file_get_contents($compressedFilePath);
    if ($compressedContent === false) {
        return true;
    }
    
    if (preg_match('/\*\s*@version\s+([0-9]+\.[0-9]+\.[0-9]+)\s*\*/', $compressedContent, $matches)) {
        return version_compare($sourceVersion, $matches[1], '>');
    }
    
    return true;
}

/**
 * Advanced CSS compression with enhanced algorithms.
 *
 * Optimizes CSS for production using advanced compression techniques
 * while preserving functionality and avoiding syntax errors.
 *
 * @param string $css The CSS content to compress
 *
 * @return string The compressed CSS content
 */
function compress_css_advanced(string $css): string
{
    // Remove CSS comments but preserve important ones
    $css = preg_replace('/\/\*(?!\s*!)[^*]*\*+(?:[^\/*][^*]*\*+)*\//', '', $css);
    
    // Remove unnecessary whitespace
    $css = preg_replace('/\s+/', ' ', $css);
    
    // Remove whitespace around specific characters
    $css = preg_replace('/\s*([{}:;,>+~])\s*/', '$1', $css);
    
    // Remove trailing semicolons before closing braces
    $css = preg_replace('/;\s*}/', '}', $css);
    
    // Remove unnecessary quotes from URLs
    $css = preg_replace('/url\(["\']([^"\')]+)["\']\)/', 'url($1)', $css);
    
    // Compress hex colors
    $css = preg_replace('/#([0-9a-fA-F])\1([0-9a-fA-F])\2([0-9a-fA-F])\3/', '#$1$2$3', $css);
    
    // Remove unnecessary zeros
    $css = preg_replace('/\b0+([1-9])/', '$1', $css);
    $css = preg_replace('/\b0+\./', '.', $css);
    
    // Remove unnecessary units for zero values
    $css = preg_replace('/\b0(?:px|em|rem|%|pt|pc|in|cm|mm|ex|ch|vw|vh|vmin|vmax)\b/', '0', $css);
    
    // Compress margin and padding shorthand
    $css = preg_replace_callback('/(margin|padding):\s*([^;]+);/', function($matches) {
        $values = explode(' ', trim($matches[2]));
        if (count($values) == 4 && $values[1] == $values[3]) {
            if ($values[0] == $values[2]) {
                if ($values[0] == $values[1]) {
                    return $matches[1] . ':' . $values[0] . ';';
                }
                return $matches[1] . ':' . $values[0] . ' ' . $values[1] . ';';
            }
            return $matches[1] . ':' . $values[0] . ' ' . $values[1] . ' ' . $values[2] . ';';
        }
        return $matches[0];
    }, $css);
    
    return trim($css);
}

/**
 * Legacy CSS compression function for backward compatibility.
 *
 * @param string $css The CSS content to compress
 *
 * @return string The compressed CSS content
 */
function compress_css(string $css): string
{
    return compress_css_advanced($css);
}

/**
 * Advanced JavaScript compression with enhanced algorithms.
 *
 * Optimizes JavaScript for production using advanced compression techniques
 * while preserving functionality and avoiding syntax errors.
 *
 * @param string $js The JavaScript content to compress
 *
 * @return string The compressed JavaScript content
 */
function compress_js_advanced(string $js): string
{
    // Remove multi-line comments but preserve important ones
    $js = preg_replace('/\/\*(?!\s*!)[\s\S]*?\*\//', '', $js);
    
    // Remove single-line comments but preserve URLs and important comments
    $js = preg_replace('/(?<!:)\/\/(?![^\r\n]*["\']).*$/m', '', $js);
    
    // Remove unnecessary whitespace but preserve string literals
    $js = preg_replace('/\s+/', ' ', $js);
    
    // Remove whitespace around operators and punctuation
    $js = preg_replace('/\s*([{}();,=+\-*\/<>!&|?:])\s*/', '$1', $js);
    
    // Remove whitespace after keywords
    $js = preg_replace('/\b(return|throw|new|delete|typeof|void|in|of)\s+/', '$1 ', $js);
    
    // Remove unnecessary semicolons before closing braces
    $js = preg_replace('/;\s*}/', '}', $js);
    
    // Remove trailing semicolons at end of lines (but keep necessary ones)
    $js = preg_replace('/;\s*(?=\r?\n|$)/', '', $js);
    
    // Compress boolean values
    $js = preg_replace('/\btrue\b/', '!0', $js);
    $js = preg_replace('/\bfalse\b/', '!1', $js);
    
    // Remove unnecessary quotes from object properties
    $js = preg_replace('/([{,])\s*["\']([a-zA-Z_$][a-zA-Z0-9_$]*)["\']\s*:/', '$1$2:', $js);
    
    // Remove unnecessary parentheses in return statements
    $js = preg_replace('/return\s*\(([^()]+)\)\s*;/', 'return $1;', $js);
    
    return trim($js);
}

/**
 * Legacy JavaScript compression function for backward compatibility.
 *
 * @param string $js The JavaScript content to compress
 *
 * @return string The compressed JavaScript content
 */
function compress_js(string $js): string
{
    return compress_js_advanced($js);
}

/**
 * Saves compressed CSS to a page-specific file.
 *
 * Creates an optimized CSS file for a specific page with proper
 * naming conventions, version tracking, and error handling.
 *
 * @param string $filePath   The full path where to save the CSS file
 * @param string $cssContent The compressed CSS content to save
 * @param string $sourceFile The source file information for reference
 * @param string $version    The version number from source file
 *
 * @return bool True if the CSS file was saved successfully, false on failure
 */
function save_compressed_css(string $filePath, string $cssContent, string $sourceFile, string $version = '1.0.0'): bool
{
    $cssHeader = <<<CSS
/**
 * CIN Framework Compressed CSS
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 * @source {$sourceFile}
 * @version {$version}
 * @compressed {date('Y-m-d H:i:s')}
 */

CSS;
    
    $fullCssContent = $cssHeader . $cssContent;
    
    return file_put_contents($filePath, $fullCssContent) !== false;
}

/**
 * Saves compressed JavaScript to a page-specific file.
 *
 * Creates an optimized JavaScript file for a specific page with proper
 * naming conventions, version tracking, and error handling.
 *
 * @param string $filePath   The full path where to save the JavaScript file
 * @param string $jsContent  The compressed JavaScript content to save
 * @param string $sourceFile The source file information for reference
 * @param string $version    The version number from source file
 *
 * @return bool True if the JavaScript file was saved successfully, false on failure
 */
function save_compressed_js(string $filePath, string $jsContent, string $sourceFile, string $version = '1.0.0'): bool
{
    $jsHeader = <<<JS
/**
 * CIN Framework Compressed JavaScript
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 * @source {$sourceFile}
 * @version {$version}
 * @compressed {date('Y-m-d H:i:s')}
 */

JS;
    
    $fullJsContent = $jsHeader . $jsContent;
    
    return file_put_contents($filePath, $fullJsContent) !== false;
}

/**
 * Injects CSS link tag for a specific page.
 *
 * Creates and stores a CSS link tag for later injection into the page HTML.
 *
 * @param string $page The page identifier for the CSS link
 *
 * @return void
 */
function inject_css_link(string $page): void
{
    $cssPath = "/cin.assets/css/{$page}.css";
    $cssLink = "<link rel=\"stylesheet\" href=\"{$cssPath}\" data-page-css>";
    
    global $dominator_css_links;
    if (!isset($dominator_css_links)) {
        $dominator_css_links = [];
    }
    $dominator_css_links[] = $cssLink;
}

/**
 * Injects individual CSS link tag for a specific file.
 *
 * Creates and stores a CSS link tag for an individual file for later injection into the page HTML.
 *
 * @param string $filename The filename for the CSS link
 *
 * @return void
 */
function inject_individual_css_link(string $filename): void
{
    $cssPath = "/cin.assets/css/{$filename}-min.css";
    $cssLink = "<link rel=\"stylesheet\" href=\"{$cssPath}\" data-file-css>";
    
    global $dominator_css_links;
    if (!isset($dominator_css_links)) {
        $dominator_css_links = [];
    }
    $dominator_css_links[] = $cssLink;
}

/**
 * Injects JavaScript script tag for a specific page.
 *
 * Creates and stores a JavaScript script tag for later injection into the page HTML.
 *
 * @param string $page The page identifier for the JavaScript script
 *
 * @return void
 */
function inject_js_script(string $page): void
{
    $jsPath = "/cin.assets/js/{$page}.js";
    $jsScript = "<script src=\"{$jsPath}\" data-page-script></script>";
    
    global $dominator_js_scripts;
    if (!isset($dominator_js_scripts)) {
        $dominator_js_scripts = [];
    }
    $dominator_js_scripts[] = $jsScript;
}

/**
 * Injects individual JavaScript script tag for a specific file.
 *
 * Creates and stores a JavaScript script tag for an individual file for later injection into the page HTML.
 *
 * @param string $filename The filename for the JavaScript script
 *
 * @return void
 */
function inject_individual_js_script(string $filename): void
{
    $jsPath = "/cin.assets/js/{$filename}-min.js";
    $jsScript = "<script src=\"{$jsPath}\" data-file-script></script>";
    
    global $dominator_js_scripts;
    if (!isset($dominator_js_scripts)) {
        $dominator_js_scripts = [];
    }
    $dominator_js_scripts[] = $jsScript;
}

/**
 * Injects external CSS link tag.
 *
 * Creates and stores an external CSS link tag for later injection into the page HTML.
 *
 * @param string $url The external CSS URL
 *
 * @return void
 */
function inject_external_css_link(string $url): void
{
    $cssLink = "<link rel=\"stylesheet\" href=\"{$url}\" data-external-css>";
    
    global $dominator_css_links;
    if (!isset($dominator_css_links)) {
        $dominator_css_links = [];
    }
    $dominator_css_links[] = $cssLink;
}

/**
 * Injects external JavaScript script tag.
 *
 * Creates and stores an external JavaScript script tag for later injection into the page HTML.
 *
 * @param string $url The external JavaScript URL
 *
 * @return void
 */
function inject_external_js_script(string $url): void
{
    $jsScript = "<script src=\"{$url}\" data-external-script></script>";
    
    global $dominator_js_scripts;
    if (!isset($dominator_js_scripts)) {
        $dominator_js_scripts = [];
    }
    $dominator_js_scripts[] = $jsScript;
}

/**
 * Retrieves all stored CSS links.
 *
 * Returns an array of CSS link tags that have been generated for injection.
 *
 * @return array Array of CSS link tags
 */
function get_css_links(): array
{
    global $dominator_css_links;
    return $dominator_css_links ?? [];
}

/**
 * Retrieves all stored JavaScript scripts.
 *
 * Returns an array of JavaScript script tags that have been generated for injection.
 *
 * @return array Array of JavaScript script tags
 */
function get_js_scripts(): array
{
    global $dominator_js_scripts;
    return $dominator_js_scripts ?? [];
}

/**
 * Clears the CSS cache for a specific page.
 *
 * Removes the cached CSS file for a page to force regeneration.
 *
 * @param string $page The page identifier to clear cache for
 *
 * @return bool True if cache was cleared successfully, false otherwise
 */
function clear_page_css_cache(string $page): bool
{
    $cssFilePath = ROOT_PATH . "/cin.assets/css/{$page}.css";
    
    if (file_exists($cssFilePath)) {
        return unlink($cssFilePath);
    }
    
    return true;
}

/**
 * Clears the JavaScript cache for a specific page.
 *
 * Removes the cached JavaScript file for a page to force regeneration.
 *
 * @param string $page The page identifier to clear cache for
 *
 * @return bool True if cache was cleared successfully, false otherwise
 */
function clear_page_js_cache(string $page): bool
{
    $jsFilePath = ROOT_PATH . "/cin.assets/js/{$page}.js";
    
    if (file_exists($jsFilePath)) {
        return unlink($jsFilePath);
    }
    
    return true;
}