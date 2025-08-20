<?php

declare(strict_types=1);

/**
 * CIN Framework Dynamic HTMX Content Manager
 *
 * Handles dynamic HTMX content loading and rendering from the public directory
 * with proper path sanitization and error handling for the DOMinator.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

/**
 * Loads and renders HTMX content from the public directory.
 *
 * Safely loads HTML, PHP, or other content files from the public directory
 * with proper path sanitization and error handling. Supports dynamic session-based content switching.
 *
 * @param string $path The relative path to the HTMX content file
 * @param array $options Optional configuration for dynamic behavior
 *
 * @return bool True if content was loaded successfully, false otherwise
 */
function dominator_htmx(string $path, array $options = []): bool
{
    try {
        $sanitizedPath = sanitize_htmx_path($path);
        
        if ($sanitizedPath === false) {
            cin_logs("Invalid or unsafe path provided to dominator_htmx: {$path}", "dev");
            return false;
        }
        
        $filePath = resolve_htmx_file_path($sanitizedPath);
        
        if ($filePath === false) {
            cin_logs("File not found for dominator_htmx path: {$path}", "file");
            return false;
        }
        
        return load_htmx_content($filePath, $path);
        
    } catch (Exception $e) {
        cin_logs("Error in dominator_htmx for path {$path}: " . $e->getMessage(), "system");
        return false;
    }
}

/**
 * Sanitizes and validates HTMX file paths for security.
 *
 * Removes dangerous path traversal sequences and validates that the path
 * contains only safe characters to prevent directory traversal attacks.
 *
 * @param string $path The path to sanitize
 *
 * @return string|false The sanitized path or false if invalid
 */
function sanitize_htmx_path(string $path): string|false
{
    $path = str_replace(['../', '..\\', '\0'], '', $path);
    
    $path = ltrim($path, '/\\');
    
    if (!preg_match('/^[a-zA-Z0-9\/\\._-]+$/', $path)) {
        return false;
    }
    
    return $path;
}

/**
 * Resolves the full file path for an HTMX content file.
 *
 * Attempts to locate the requested file in the public directory with
 * various extensions (html, php) and returns the full path if found.
 *
 * @param string $sanitizedPath The sanitized relative path
 *
 * @return string|false The full file path or false if not found
 */
function resolve_htmx_file_path(string $sanitizedPath): string|false
{
    $publicDir = ROOT_PATH . '/public';
    
    $extensions = ['html', 'php'];
    
    foreach ($extensions as $ext) {
        $fullPath = $publicDir . '/' . $sanitizedPath . '.' . $ext;
        
        if (file_exists($fullPath) && is_file($fullPath)) {
            return $fullPath;
        }
    }
    
    $fullPath = $publicDir . '/' . $sanitizedPath;
    if (file_exists($fullPath) && is_file($fullPath)) {
        return $fullPath;
    }
    
    return false;
}

/**
 * Loads and outputs HTMX content based on file type.
 *
 * Handles different file types appropriately: executes PHP files,
 * outputs HTML files directly, and escapes other content for security.
 *
 * @param string $filePath    The full path to the content file
 * @param string $originalPath The original requested path for logging
 *
 * @return bool True if content was loaded successfully, false otherwise
 */
function load_htmx_content(string $filePath, string $originalPath): bool
{
    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    
    try {
        switch ($fileExtension) {
            case 'php':
                ob_start();
                include $filePath;
                $content = ob_get_clean();
                echo $content;
                break;
                
            case 'html':
            case 'htm':
                $content = file_get_contents($filePath);
                if ($content === false) {
                    cin_logs("Failed to read HTML file: {$filePath}", "file");
                    return false;
                }
                echo $content;
                break;
                
            default:
                $content = file_get_contents($filePath);
                if ($content === false) {
                    cin_logs("Failed to read file: {$filePath}", "file");
                    return false;
                }
                echo htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
                break;
        }
        
        cin_logs("Successfully loaded HTMX content from: {$originalPath}", "success");
        return true;
        
    } catch (Exception $e) {
        cin_logs("Error loading HTMX content from {$filePath}: " . $e->getMessage(), "system");
        return false;
    }
}

/**
 * Retrieves a list of available HTMX files in the public directory.
 *
 * Recursively scans the public directory or a specified subdirectory
 * to return all available files for HTMX loading.
 *
 * @param string $subdirectory Optional subdirectory to scan within public
 *
 * @return array Array of relative file paths available for HTMX loading
 */
function get_available_htmx_files(string $subdirectory = ''): array
{
    $publicDir = ROOT_PATH . '/public';
    $scanDir = $publicDir;
    
    if (!empty($subdirectory)) {
        $sanitizedSubdir = sanitize_htmx_path($subdirectory);
        if ($sanitizedSubdir !== false) {
            $scanDir = $publicDir . '/' . $sanitizedSubdir;
        }
    }
    
    if (!is_dir($scanDir)) {
        return [];
    }
    
    $files = [];
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($scanDir, RecursiveDirectoryIterator::SKIP_DOTS)
    );
    
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $relativePath = str_replace($publicDir . '/', '', $file->getPathname());
            $relativePath = str_replace('\\', '/', $relativePath);
            $files[] = $relativePath;
        }
    }
    
    return $files;
}

/**
 * Checks if an HTMX file exists in the public directory.
 *
 * Validates and checks for the existence of a file that can be loaded
 * via the HTMX system with proper path sanitization.
 *
 * @param string $path The relative path to check
 *
 * @return bool True if the file exists and is accessible, false otherwise
 */
function htmx_file_exists(string $path): bool
{
    $sanitizedPath = sanitize_htmx_path($path);
    if ($sanitizedPath === false) {
        return false;
    }
    
    return resolve_htmx_file_path($sanitizedPath) !== false;
}