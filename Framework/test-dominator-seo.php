<?php

declare(strict_types=1);

require_once __DIR__ . '/cin/cin.php';

// Test all dominator_seo_meta_ functions
dominator_seo_meta_titel('CIN Framework - Complete SEO Test');
dominator_seo_meta_description('This is a comprehensive test page for all CIN Framework SEO functions and dynamic variables.');
dominator_seo_meta_keywords('CIN Framework, PHP, SEO, Test, Meta Tags, Open Graph, Twitter Cards');
dominator_seo_meta_author('Ayoub Alarjani (MAWI MAN)');
dominator_seo_meta_robots('index, follow');
dominator_seo_meta_image('https://www.cin-framework.com/assets/images/logo.png');
dominator_seo_meta_url('https://www.cin-framework.com/test-seo');
dominator_seo_meta_site_name('CIN Framework');
dominator_seo_meta_viewport('width=device-width, initial-scale=1.0');
dominator_seo_meta_copyright('© 2024 CIN Framework. All rights reserved.');
dominator_seo_meta_language('ar');
dominator_seo_meta_revisit_after('7 days');
dominator_seo_meta_rating('general');
dominator_seo_meta_distribution('global');
dominator_seo_meta_coverage('worldwide');
dominator_seo_meta_theme_color('#007bff');
dominator_seo_meta_mobile_web_app_capable('yes');
dominator_seo_meta_apple_mobile_web_app_capable('yes');
dominator_seo_meta_apple_mobile_web_app_status_bar_style('black-translucent');
dominator_seo_meta_format_detection('telephone=no');

// Test Open Graph and Twitter functions
dominator_seo_og_type('website');
dominator_seo_og_title('CIN Framework - Complete SEO Test (OG)');
dominator_seo_og_description('This is the Open Graph description for CIN Framework SEO test page.');
dominator_seo_og_image('https://www.cin-framework.com/assets/images/og-logo.png');
dominator_seo_og_url('https://www.cin-framework.com/test-seo-og');
dominator_seo_og_site_name('CIN Framework Official');

dominator_seo_twitter_card('summary_large_image');
dominator_seo_twitter_title('CIN Framework - Complete SEO Test (Twitter)');
dominator_seo_twitter_description('This is the Twitter description for CIN Framework SEO test page.');
dominator_seo_twitter_image('https://www.cin-framework.com/assets/images/twitter-logo.png');

// Test Article functions
dominator_seo_article_author('Ayoub Alarjani (MAWI MAN) - Article Author');
dominator_seo_article_published_time('2024-01-15T10:00:00Z');
dominator_seo_article_modified_time('2024-01-16T15:30:00Z');
dominator_seo_article_section('Technology');
dominator_seo_article_tag('PHP, Framework, SEO');

// Test Geo functions
dominator_seo_geo_region('MA');
dominator_seo_geo_placename('Fés');
dominator_seo_geo_position('34.0331,-5.0003');

// Test Structured Data functions
dominator_seo_structured_data_type('WebPage');
dominator_seo_structured_data_name('CIN Framework Test Page');
dominator_seo_structured_data_description('Complete test page for CIN Framework SEO system');
dominator_seo_structured_data_url('https://www.cin-framework.com/test-seo');

dominator();

?>

<div style="padding: 20px; font-family: Arial, sans-serif;">
    <h1>CIN Framework - Complete SEO System Test</h1>
    
    <div style="background: #f5f5f5; padding: 15px; margin: 20px 0; border-radius: 5px;">
        <h2>Meta SEO Functions:</h2>
        <ul>
            <li><strong>dominator_seo_meta_titel():</strong> {{dominator_seo_meta_titel}}</li>
            <li><strong>dominator_seo_meta_description():</strong> {{dominator_seo_meta_description}}</li>
            <li><strong>dominator_seo_meta_keywords():</strong> {{dominator_seo_meta_keywords}}</li>
            <li><strong>dominator_seo_meta_author():</strong> {{dominator_seo_meta_author}}</li>
            <li><strong>dominator_seo_meta_robots():</strong> {{dominator_seo_meta_robots}}</li>
            <li><strong>dominator_seo_meta_image():</strong> {{dominator_seo_meta_image}}</li>
            <li><strong>dominator_seo_meta_url():</strong> {{dominator_seo_meta_url}}</li>
            <li><strong>dominator_seo_meta_site_name():</strong> {{dominator_seo_meta_site_name}}</li>
            <li><strong>dominator_seo_meta_viewport():</strong> {{dominator_seo_meta_viewport}}</li>
            <li><strong>dominator_seo_meta_copyright():</strong> {{dominator_seo_meta_copyright}}</li>
            <li><strong>dominator_seo_meta_language():</strong> {{dominator_seo_meta_language}}</li>
            <li><strong>dominator_seo_meta_revisit_after():</strong> {{dominator_seo_meta_revisit_after}}</li>
            <li><strong>dominator_seo_meta_rating():</strong> {{dominator_seo_meta_rating}}</li>
            <li><strong>dominator_seo_meta_distribution():</strong> {{dominator_seo_meta_distribution}}</li>
            <li><strong>dominator_seo_meta_coverage():</strong> {{dominator_seo_meta_coverage}}</li>
            <li><strong>dominator_seo_meta_theme_color():</strong> {{dominator_seo_meta_theme_color}}</li>
            <li><strong>dominator_seo_meta_mobile_web_app_capable():</strong> {{dominator_seo_meta_mobile_web_app_capable}}</li>
            <li><strong>dominator_seo_meta_apple_mobile_web_app_capable():</strong> {{dominator_seo_meta_apple_mobile_web_app_capable}}</li>
            <li><strong>dominator_seo_meta_apple_mobile_web_app_status_bar_style():</strong> {{dominator_seo_meta_apple_mobile_web_app_status_bar_style}}</li>
            <li><strong>dominator_seo_meta_format_detection():</strong> {{dominator_seo_meta_format_detection}}</li>
        </ul>
        
        <h3>Open Graph Functions:</h3>
        <ul>
            <li><strong>dominator_seo_og_type():</strong> {{dominator_seo_og_type}}</li>
            <li><strong>dominator_seo_og_title():</strong> {{dominator_seo_og_title}}</li>
            <li><strong>dominator_seo_og_description():</strong> {{dominator_seo_og_description}}</li>
            <li><strong>dominator_seo_og_image():</strong> {{dominator_seo_og_image}}</li>
            <li><strong>dominator_seo_og_url():</strong> {{dominator_seo_og_url}}</li>
            <li><strong>dominator_seo_og_site_name():</strong> {{dominator_seo_og_site_name}}</li>
        </ul>
        
        <h3>Twitter Functions:</h3>
        <ul>
            <li><strong>dominator_seo_twitter_card():</strong> {{dominator_seo_twitter_card}}</li>
            <li><strong>dominator_seo_twitter_title():</strong> {{dominator_seo_twitter_title}}</li>
            <li><strong>dominator_seo_twitter_description():</strong> {{dominator_seo_twitter_description}}</li>
            <li><strong>dominator_seo_twitter_image():</strong> {{dominator_seo_twitter_image}}</li>
        </ul>
        
        <h3>Article Functions:</h3>
        <ul>
            <li><strong>dominator_seo_article_author():</strong> {{dominator_seo_article_author}}</li>
            <li><strong>dominator_seo_article_published_time():</strong> {{dominator_seo_article_published_time}}</li>
            <li><strong>dominator_seo_article_modified_time():</strong> {{dominator_seo_article_modified_time}}</li>
            <li><strong>dominator_seo_article_section():</strong> {{dominator_seo_article_section}}</li>
            <li><strong>dominator_seo_article_tag():</strong> {{dominator_seo_article_tag}}</li>
        </ul>
        
        <h3>Geo Functions:</h3>
        <ul>
            <li><strong>dominator_seo_geo_region():</strong> {{dominator_seo_geo_region}}</li>
            <li><strong>dominator_seo_geo_placename():</strong> {{dominator_seo_geo_placename}}</li>
            <li><strong>dominator_seo_geo_position():</strong> {{dominator_seo_geo_position}}</li>
        </ul>
        
        <h3>Structured Data Functions:</h3>
        <ul>
            <li><strong>dominator_seo_structured_data_type():</strong> {{dominator_seo_structured_data_type}}</li>
            <li><strong>dominator_seo_structured_data_name():</strong> {{dominator_seo_structured_data_name}}</li>
            <li><strong>dominator_seo_structured_data_description():</strong> {{dominator_seo_structured_data_description}}</li>
            <li><strong>dominator_seo_structured_data_url():</strong> {{dominator_seo_structured_data_url}}</li>
        </ul>
    </div>
    
    <div style="background: #e8f5e8; padding: 15px; margin: 20px 0; border-radius: 5px;">
        <h2>All Available Dynamic Variables (43 total):</h2>
        <p>You can use these variables anywhere in your website:</p>
        <ol>
            <li>{{dominator_seo_meta_titel}}</li>
            <li>{{dominator_seo_meta_description}}</li>
            <li>{{dominator_seo_meta_keywords}}</li>
            <li>{{dominator_seo_meta_author}}</li>
            <li>{{dominator_seo_meta_robots}}</li>
            <li>{{dominator_seo_meta_image}}</li>
            <li>{{dominator_seo_meta_url}}</li>
            <li>{{dominator_seo_meta_site_name}}</li>
            <li>{{dominator_seo_meta_viewport}}</li>
            <li>{{dominator_seo_meta_copyright}}</li>
            <li>{{dominator_seo_meta_language}}</li>
            <li>{{dominator_seo_meta_revisit_after}}</li>
            <li>{{dominator_seo_meta_rating}}</li>
            <li>{{dominator_seo_meta_distribution}}</li>
            <li>{{dominator_seo_meta_coverage}}</li>
            <li>{{dominator_seo_meta_theme_color}}</li>
            <li>{{dominator_seo_meta_mobile_web_app_capable}}</li>
            <li>{{dominator_seo_meta_apple_mobile_web_app_capable}}</li>
            <li>{{dominator_seo_meta_apple_mobile_web_app_status_bar_style}}</li>
            <li>{{dominator_seo_meta_format_detection}}</li>
            <li>{{dominator_seo_og_type}}</li>
            <li>{{dominator_seo_og_title}}</li>
            <li>{{dominator_seo_og_description}}</li>
            <li>{{dominator_seo_og_image}}</li>
            <li>{{dominator_seo_og_url}}</li>
            <li>{{dominator_seo_og_site_name}}</li>
            <li>{{dominator_seo_twitter_card}}</li>
            <li>{{dominator_seo_twitter_title}}</li>
            <li>{{dominator_seo_twitter_description}}</li>
            <li>{{dominator_seo_twitter_image}}</li>
            <li>{{dominator_seo_article_author}}</li>
            <li>{{dominator_seo_article_published_time}}</li>
            <li>{{dominator_seo_article_modified_time}}</li>
            <li>{{dominator_seo_article_section}}</li>
            <li>{{dominator_seo_article_tag}}</li>
            <li>{{dominator_seo_geo_region}}</li>
            <li>{{dominator_seo_geo_placename}}</li>
            <li>{{dominator_seo_geo_position}}</li>
            <li>{{dominator_seo_structured_data_type}}</li>
            <li>{{dominator_seo_structured_data_name}}</li>
            <li>{{dominator_seo_structured_data_description}}</li>
            <li>{{dominator_seo_structured_data_url}}</li>
        </ol>
    </div>
    
    <div style="background: #fff3cd; padding: 15px; margin: 20px 0; border-radius: 5px;">
        <h2>How to Use:</h2>
        <p>1. Use the functions before calling <code>dominator()</code></p>
        <p>2. You can use the variables in SEO JSON files</p>
        <p>3. The system supports both dynamic and static control as per developer choice</p>
        <p>4. All 43 variables are now available for complete SEO control</p>
    </div>
    
    <p><strong>Check the page source to see the updated meta tags!</strong></p>
</div>

</body>
</html>