<?php

declare(strict_types=1);

/**
 * CIN Framework HTML Structure Generator
 *
 * Handles complete HTML document structure generation including DOCTYPE,
 * head section, SEO metadata, and body initialization for the DOMinator.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

/**
 * Generates the complete HTML structure for the current page.
 *
 * Creates the DOCTYPE, html, head, and body opening tags with proper
 * SEO metadata, language configuration, CSS links, and sets up output
 * buffering for content processing.
 *
 * @return void
 */
function generate_html_structure(): void
{
    if (headers_sent()) {
        cin_logs("Headers already sent. Cannot modify HTML structure.", "dev");
        return;
    }

    global $dominator_supported_languages;
    if (!empty($dominator_supported_languages)) {
        handle_language_switch($dominator_supported_languages);
    }

    ob_start();

    $page = basename($_SERVER['PHP_SELF'], '.php');
    manage_page_seo($page);
    $seoMeta = apply_seo_meta($page);
    
    $cssLinks = get_css_links();
    $jsScripts = get_js_scripts();
    
    $currentLang = dominator_get_lang();
    $currentDir = dominator_get_dir();
    
    $customDir = get_custom_direction($page, $currentLang);
    if ($customDir !== null) {
        $currentDir = $customDir;
    }

    $html = <<<HTML
<!DOCTYPE html>
<html lang="{$currentLang}" dir="{$currentDir}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
{$seoMeta}
HTML;

    if (!empty($cssLinks)) {
        foreach ($cssLinks as $cssLink) {
            $html .= "    {$cssLink}\n";
        }
    }
    
    $html .= "</head>\n<body>";

    echo format_html($html);

    register_shutdown_function(function () use ($page, $currentLang, $jsScripts) {
        $content = ob_get_clean();
        $content = process_translations($content, $page, $currentLang);

        $languageSwitcherJs = '<script src="/cin.assets/core.min.js"></script>';
        
        $jsScriptsHtml = '';
        if (!empty($jsScripts)) {
            foreach ($jsScripts as $jsScript) {
                $jsScriptsHtml .= "    {$jsScript}\n";
            }
        }
        
        $footer = $jsScriptsHtml . $languageSwitcherJs . "\n</body>\n</html>";
        echo $content . format_html($footer);
    });
}
