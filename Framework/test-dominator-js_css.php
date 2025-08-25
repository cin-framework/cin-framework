<?php
declare(strict_types=1);

/**
 * CIN Framework CSS and JavaScript Test Page
 *
 * This page tests the enhanced CSS and JavaScript compression system
 * with version control to avoid redundant compression.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

require_once __DIR__ . '/cin/cin.php';

// Test the enhanced compression system
dominator_style('test-style');
dominator_script('test-script');

// Test URL-based assets
dominator_style_url('https://www.example.com/style.css','https://example.com/style_2.css'); 
dominator_script_url('https://www.example.com/script.js','https://example.com/script_2.js');
