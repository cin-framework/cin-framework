<?php

declare(strict_types=1);

/**
 * CIN Framework SEO Management System
 *
 * Handles SEO metadata generation, dynamic title management,
 * and comprehensive SEO optimization for the DOMinator component.
 *
 * @package CIN Framework
 * @author Ayoub Alarjani (MAWI MAN)
 * @license Proprietary - All rights reserved to CIN Framework
 */

/**
 * Global variables to store dynamic SEO values.
 */
$dominator_dynamic_seo_values = [];

/**
 * Sets the dynamic SEO meta title for the current page.
 *
 * Stores the title value in a global variable for dynamic replacement
 * during SEO meta tag generation without modifying the JSON file.
 *
 * @param string $title The title to set for the current page
 *
 * @return bool True if title was set successfully, false otherwise
 */
function dominator_seo_meta_titel(string $title): bool
{
    return set_dynamic_seo_value('titel', $title);
}

/**
 * Sets the dynamic SEO meta description for the current page.
 *
 * @param string $description The description to set for the current page
 *
 * @return bool True if description was set successfully, false otherwise
 */
function dominator_seo_meta_description(string $description): bool
{
    return set_dynamic_seo_value('description', $description);
}

/**
 * Sets the dynamic SEO meta keywords for the current page.
 *
 * @param string $keywords The keywords to set for the current page
 *
 * @return bool True if keywords were set successfully, false otherwise
 */
function dominator_seo_meta_keywords(string $keywords): bool
{
    return set_dynamic_seo_value('keywords', $keywords);
}

/**
 * Sets the dynamic SEO meta author for the current page.
 *
 * @param string $author The author to set for the current page
 *
 * @return bool True if author was set successfully, false otherwise
 */
function dominator_seo_meta_author(string $author): bool
{
    return set_dynamic_seo_value('author', $author);
}

/**
 * Sets the dynamic SEO meta robots directive for the current page.
 *
 * @param string $robots The robots directive to set for the current page
 *
 * @return bool True if robots directive was set successfully, false otherwise
 */
function dominator_seo_meta_robots(string $robots): bool
{
    return set_dynamic_seo_value('robots', $robots);
}

/**
 * Sets the dynamic SEO meta image for the current page.
 *
 * @param string $image The image URL to set for the current page
 *
 * @return bool True if image was set successfully, false otherwise
 */
function dominator_seo_meta_image(string $image): bool
{
    return set_dynamic_seo_value('image', $image);
}

/**
 * Sets the dynamic SEO meta URL for the current page.
 *
 * @param string $url The URL to set for the current page
 *
 * @return bool True if URL was set successfully, false otherwise
 */
function dominator_seo_meta_url(string $url): bool
{
    return set_dynamic_seo_value('url', $url);
}

/**
 * Sets the dynamic SEO meta site name for the current page.
 *
 * @param string $siteName The site name to set for the current page
 *
 * @return bool True if site name was set successfully, false otherwise
 */
function dominator_seo_meta_site_name(string $siteName): bool
{
    return set_dynamic_seo_value('site_name', $siteName);
}

/**
 * Sets the dynamic SEO meta viewport for the current page.
 *
 * @param string $viewport The viewport to set for the current page
 *
 * @return bool True if viewport was set successfully, false otherwise
 */
function dominator_seo_meta_viewport(string $viewport): bool
{
    return set_dynamic_seo_value('viewport', $viewport);
}

/**
 * Sets the dynamic SEO meta copyright for the current page.
 *
 * @param string $copyright The copyright to set for the current page
 *
 * @return bool True if copyright was set successfully, false otherwise
 */
function dominator_seo_meta_copyright(string $copyright): bool
{
    return set_dynamic_seo_value('copyright', $copyright);
}

/**
 * Sets the dynamic SEO meta language for the current page.
 *
 * @param string $language The language to set for the current page
 *
 * @return bool True if language was set successfully, false otherwise
 */
function dominator_seo_meta_language(string $language): bool
{
    return set_dynamic_seo_value('language', $language);
}

/**
 * Sets the dynamic SEO meta revisit-after for the current page.
 *
 * @param string $revisitAfter The revisit-after to set for the current page
 *
 * @return bool True if revisit-after was set successfully, false otherwise
 */
function dominator_seo_meta_revisit_after(string $revisitAfter): bool
{
    return set_dynamic_seo_value('revisit-after', $revisitAfter);
}

/**
 * Sets the dynamic SEO meta rating for the current page.
 *
 * @param string $rating The rating to set for the current page
 *
 * @return bool True if rating was set successfully, false otherwise
 */
function dominator_seo_meta_rating(string $rating): bool
{
    return set_dynamic_seo_value('rating', $rating);
}

/**
 * Sets the dynamic SEO meta distribution for the current page.
 *
 * @param string $distribution The distribution to set for the current page
 *
 * @return bool True if distribution was set successfully, false otherwise
 */
function dominator_seo_meta_distribution(string $distribution): bool
{
    return set_dynamic_seo_value('distribution', $distribution);
}

/**
 * Sets the dynamic SEO meta coverage for the current page.
 *
 * @param string $coverage The coverage to set for the current page
 *
 * @return bool True if coverage was set successfully, false otherwise
 */
function dominator_seo_meta_coverage(string $coverage): bool
{
    return set_dynamic_seo_value('coverage', $coverage);
}

/**
 * Sets the dynamic SEO meta theme-color for the current page.
 *
 * @param string $themeColor The theme-color to set for the current page
 *
 * @return bool True if theme-color was set successfully, false otherwise
 */
function dominator_seo_meta_theme_color(string $themeColor): bool
{
    return set_dynamic_seo_value('theme-color', $themeColor);
}

/**
 * Sets the dynamic SEO meta mobile-web-app-capable for the current page.
 *
 * @param string $mobileWebAppCapable The mobile-web-app-capable to set for the current page
 *
 * @return bool True if mobile-web-app-capable was set successfully, false otherwise
 */
function dominator_seo_meta_mobile_web_app_capable(string $mobileWebAppCapable): bool
{
    return set_dynamic_seo_value('mobile-web-app-capable', $mobileWebAppCapable);
}

/**
 * Sets the dynamic SEO meta apple-mobile-web-app-capable for the current page.
 *
 * @param string $appleMobileWebAppCapable The apple-mobile-web-app-capable to set for the current page
 *
 * @return bool True if apple-mobile-web-app-capable was set successfully, false otherwise
 */
function dominator_seo_meta_apple_mobile_web_app_capable(string $appleMobileWebAppCapable): bool
{
    return set_dynamic_seo_value('apple-mobile-web-app-capable', $appleMobileWebAppCapable);
}

/**
 * Sets the dynamic SEO meta apple-mobile-web-app-status-bar-style for the current page.
 *
 * @param string $appleStatusBarStyle The apple-mobile-web-app-status-bar-style to set for the current page
 *
 * @return bool True if apple-mobile-web-app-status-bar-style was set successfully, false otherwise
 */
function dominator_seo_meta_apple_mobile_web_app_status_bar_style(string $appleStatusBarStyle): bool
{
    return set_dynamic_seo_value('apple-mobile-web-app-status-bar-style', $appleStatusBarStyle);
}

/**
 * Sets the dynamic SEO meta format-detection for the current page.
 *
 * @param string $formatDetection The format-detection to set for the current page
 *
 * @return bool True if format-detection was set successfully, false otherwise
 */
function dominator_seo_meta_format_detection(string $formatDetection): bool
{
    return set_dynamic_seo_value('format-detection', $formatDetection);
}

/**
 * Sets the dynamic SEO Open Graph type for the current page.
 *
 * @param string $ogType The Open Graph type to set for the current page
 *
 * @return bool True if Open Graph type was set successfully, false otherwise
 */
function dominator_seo_og_type(string $ogType): bool
{
    return set_dynamic_seo_value('og_type', $ogType);
}

/**
 * Sets the dynamic SEO Twitter card for the current page.
 *
 * @param string $twitterCard The Twitter card to set for the current page
 *
 * @return bool True if Twitter card was set successfully, false otherwise
 */
function dominator_seo_twitter_card(string $twitterCard): bool
{
    return set_dynamic_seo_value('twitter_card', $twitterCard);
}

/**
 * Sets the dynamic SEO Open Graph title for the current page.
 *
 * @param string $ogTitle The Open Graph title to set for the current page
 *
 * @return bool True if Open Graph title was set successfully, false otherwise
 */
function dominator_seo_og_title(string $ogTitle): bool
{
    return set_dynamic_seo_value('og_title', $ogTitle);
}

/**
 * Sets the dynamic SEO Open Graph description for the current page.
 *
 * @param string $ogDescription The Open Graph description to set for the current page
 *
 * @return bool True if Open Graph description was set successfully, false otherwise
 */
function dominator_seo_og_description(string $ogDescription): bool
{
    return set_dynamic_seo_value('og_description', $ogDescription);
}

/**
 * Sets the dynamic SEO Open Graph image for the current page.
 *
 * @param string $ogImage The Open Graph image to set for the current page
 *
 * @return bool True if Open Graph image was set successfully, false otherwise
 */
function dominator_seo_og_image(string $ogImage): bool
{
    return set_dynamic_seo_value('og_image', $ogImage);
}

/**
 * Sets the dynamic SEO Open Graph URL for the current page.
 *
 * @param string $ogUrl The Open Graph URL to set for the current page
 *
 * @return bool True if Open Graph URL was set successfully, false otherwise
 */
function dominator_seo_og_url(string $ogUrl): bool
{
    return set_dynamic_seo_value('og_url', $ogUrl);
}

/**
 * Sets the dynamic SEO Open Graph site name for the current page.
 *
 * @param string $ogSiteName The Open Graph site name to set for the current page
 *
 * @return bool True if Open Graph site name was set successfully, false otherwise
 */
function dominator_seo_og_site_name(string $ogSiteName): bool
{
    return set_dynamic_seo_value('og_site_name', $ogSiteName);
}

/**
 * Sets the dynamic SEO Twitter title for the current page.
 *
 * @param string $twitterTitle The Twitter title to set for the current page
 *
 * @return bool True if Twitter title was set successfully, false otherwise
 */
function dominator_seo_twitter_title(string $twitterTitle): bool
{
    return set_dynamic_seo_value('twitter_title', $twitterTitle);
}

/**
 * Sets the dynamic SEO Twitter description for the current page.
 *
 * @param string $twitterDescription The Twitter description to set for the current page
 *
 * @return bool True if Twitter description was set successfully, false otherwise
 */
function dominator_seo_twitter_description(string $twitterDescription): bool
{
    return set_dynamic_seo_value('twitter_description', $twitterDescription);
}

/**
 * Sets the dynamic SEO Twitter image for the current page.
 *
 * @param string $twitterImage The Twitter image to set for the current page
 *
 * @return bool True if Twitter image was set successfully, false otherwise
 */
function dominator_seo_twitter_image(string $twitterImage): bool
{
    return set_dynamic_seo_value('twitter_image', $twitterImage);
}

/**
 * Sets the dynamic SEO article author for the current page.
 *
 * @param string $articleAuthor The article author to set for the current page
 *
 * @return bool True if article author was set successfully, false otherwise
 */
function dominator_seo_article_author(string $articleAuthor): bool
{
    return set_dynamic_seo_value('article_author', $articleAuthor);
}

/**
 * Sets the dynamic SEO article published time for the current page.
 *
 * @param string $publishedTime The published time to set for the current page
 *
 * @return bool True if published time was set successfully, false otherwise
 */
function dominator_seo_article_published_time(string $publishedTime): bool
{
    return set_dynamic_seo_value('article_published_time', $publishedTime);
}

/**
 * Sets the dynamic SEO article modified time for the current page.
 *
 * @param string $modifiedTime The modified time to set for the current page
 *
 * @return bool True if modified time was set successfully, false otherwise
 */
function dominator_seo_article_modified_time(string $modifiedTime): bool
{
    return set_dynamic_seo_value('article_modified_time', $modifiedTime);
}

/**
 * Sets the dynamic SEO article section for the current page.
 *
 * @param string $section The section to set for the current page
 *
 * @return bool True if section was set successfully, false otherwise
 */
function dominator_seo_article_section(string $section): bool
{
    return set_dynamic_seo_value('article_section', $section);
}

/**
 * Sets the dynamic SEO article tag for the current page.
 *
 * @param string $tag The tag to set for the current page
 *
 * @return bool True if tag was set successfully, false otherwise
 */
function dominator_seo_article_tag(string $tag): bool
{
    return set_dynamic_seo_value('article_tag', $tag);
}

/**
 * Sets the dynamic SEO geo region for the current page.
 *
 * @param string $region The region to set for the current page
 *
 * @return bool True if region was set successfully, false otherwise
 */
function dominator_seo_geo_region(string $region): bool
{
    return set_dynamic_seo_value('geo_region', $region);
}

/**
 * Sets the dynamic SEO geo placename for the current page.
 *
 * @param string $placename The placename to set for the current page
 *
 * @return bool True if placename was set successfully, false otherwise
 */
function dominator_seo_geo_placename(string $placename): bool
{
    return set_dynamic_seo_value('geo_placename', $placename);
}

/**
 * Sets the dynamic SEO geo position for the current page.
 *
 * @param string $position The position to set for the current page
 *
 * @return bool True if position was set successfully, false otherwise
 */
function dominator_seo_geo_position(string $position): bool
{
    return set_dynamic_seo_value('geo_position', $position);
}

/**
 * Sets the dynamic SEO structured data type for the current page.
 *
 * @param string $type The type to set for the current page
 *
 * @return bool True if type was set successfully, false otherwise
 */
function dominator_seo_structured_data_type(string $type): bool
{
    return set_dynamic_seo_value('structured_data_type', $type);
}

/**
 * Sets the dynamic SEO structured data name for the current page.
 *
 * @param string $name The name to set for the current page
 *
 * @return bool True if name was set successfully, false otherwise
 */
function dominator_seo_structured_data_name(string $name): bool
{
    return set_dynamic_seo_value('structured_data_name', $name);
}

/**
 * Sets the dynamic SEO structured data description for the current page.
 *
 * @param string $description The description to set for the current page
 *
 * @return bool True if description was set successfully, false otherwise
 */
function dominator_seo_structured_data_description(string $description): bool
{
    return set_dynamic_seo_value('structured_data_description', $description);
}

/**
 * Sets the dynamic SEO structured data URL for the current page.
 *
 * @param string $url The URL to set for the current page
 *
 * @return bool True if URL was set successfully, false otherwise
 */
function dominator_seo_structured_data_url(string $url): bool
{
    return set_dynamic_seo_value('structured_data_url', $url);
}

/**
 * Generic function to set dynamic SEO values.
 *
 * @param string $key   The SEO property key
 * @param string $value The value to set
 *
 * @return bool True if value was set successfully, false otherwise
 */
function set_dynamic_seo_value(string $key, string $value): bool
{
    global $dominator_dynamic_seo_values;
    
    if (empty($value)) {
        cin_logs("Empty value provided for dominator_seo_{$key}", "dev");
        return false;
    }
    
    $dominator_dynamic_seo_values[$key] = $value;
    cin_logs("Dynamic SEO {$key} set: {$value}", "success");
    return true;
}

/**
 * Applies SEO metadata for a specific page.
 *
 * Reads the SEO configuration file for the page and generates HTML meta tags
 * including standard meta tags, Open Graph, Twitter Cards, Article, and Geo tags.
 * Dynamically replaces {{dominator_seo_titel}} placeholder with the set title.
 *
 * @param string $page The page identifier to apply SEO metadata for
 *
 * @return string The generated HTML meta tags or empty string if no config found
 */
function apply_seo_meta(string $page): string
{
    $seoFile = ROOT_PATH . '/.cin/seo/' . $page . '.json';
    if (!file_exists($seoFile)) {
        return '';
    }

    $seoConfig = json_decode(file_get_contents($seoFile), true);
    if (!$seoConfig) {
        return '';
    }

    global $dominator_dynamic_seo_values;
    $dynamicValues = $dominator_dynamic_seo_values ?? [];

    $metaTags = '';

    if (isset($seoConfig['meta']) && is_array($seoConfig['meta'])) {
        foreach ($seoConfig['meta'] as $name => $content) {
            if (empty($content)) {
                continue;
            }
            
            $processedContent = replace_dynamic_placeholders($content, $dynamicValues);
            
            if ($name === 'title') {
                $metaTags .= "    <title>$processedContent</title>\n";
            } else {
                $metaTags .= "    <meta name=\"$name\" content=\"$processedContent\">\n";
            }
        }
    }

    if (isset($seoConfig['og']) && is_array($seoConfig['og'])) {
        foreach ($seoConfig['og'] as $property => $content) {
            if (empty($content)) {
                continue;
            }
            
            $processedContent = replace_dynamic_placeholders($content, $dynamicValues);
            $metaTags .= "    <meta property=\"og:$property\" content=\"$processedContent\">\n";
        }
    }

    if (isset($seoConfig['twitter']) && is_array($seoConfig['twitter'])) {
        foreach ($seoConfig['twitter'] as $name => $content) {
            if (empty($content)) {
                continue;
            }
            
            $processedContent = replace_dynamic_placeholders($content, $dynamicValues);
            $metaTags .= "    <meta name=\"twitter:$name\" content=\"$processedContent\">\n";
        }
    }

    if (isset($seoConfig['article']) && is_array($seoConfig['article'])) {
        foreach ($seoConfig['article'] as $property => $content) {
            if (empty($content)) {
                continue;
            }
            
            $processedContent = replace_dynamic_placeholders($content, $dynamicValues);
            $metaTags .= "    <meta property=\"article:$property\" content=\"$processedContent\">\n";
        }
    }

    if (isset($seoConfig['geo']) && is_array($seoConfig['geo'])) {
        foreach ($seoConfig['geo'] as $name => $content) {
            if (empty($content)) {
                continue;
            }
            
            $processedContent = replace_dynamic_placeholders($content, $dynamicValues);
            $metaTags .= "    <meta name=\"geo.$name\" content=\"$processedContent\">\n";
        }
    }

    return $metaTags;
}

/**
 * Replaces dynamic placeholders in content with actual values.
 *
 * Processes content string and replaces all {{dominator_seo_*}} placeholders
 * with their corresponding dynamic values.
 *
 * @param string $content       The content containing placeholders
 * @param array  $dynamicValues Array of dynamic SEO values
 *
 * @return string The processed content with replaced placeholders
 */
function replace_dynamic_placeholders(string $content, array $dynamicValues): string
{
    foreach ($dynamicValues as $key => $value) {
        // Handle both short and full placeholder names
        $shortPlaceholder = "{{dominator_seo_{$key}}}";
        $fullPlaceholder = "{{dominator_seo_meta_{$key}}}";
        
        $content = str_replace($shortPlaceholder, $value, $content);
        $content = str_replace($fullPlaceholder, $value, $content);
        
        // Handle specific mappings for different categories
        $categoryMappings = [
            'og_' => 'og',
            'twitter_' => 'twitter', 
            'article_' => 'article',
            'geo_' => 'geo',
            'structured_data_' => 'structured_data'
        ];
        
        foreach ($categoryMappings as $prefix => $category) {
            if (strpos($key, $prefix) === 0) {
                $categoryKey = substr($key, strlen($prefix));
                $categoryPlaceholder = "{{dominator_seo_{$category}_{$categoryKey}}}";
                $content = str_replace($categoryPlaceholder, $value, $content);
            }
        }
    }
    
    return $content;
}
