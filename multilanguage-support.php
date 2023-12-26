<?php
/*
File Name: multilanguage-support.php
Description: Provides multilanguage support for the AI Content Architect plugin.
*/

// Prevent direct file access
defined('ABSPATH') or die('No script kiddies please!');

// Include OpenAI API file
require_once plugin_dir_path(__FILE__) . 'openai-api.php';

// Function to translate content to a specified language
function translate_content($content, $target_language) {
    // Prepare the prompt for OpenAI
    $prompt = "Translate the following English text to " . $target_language . ": " . $content;

    // Call the OpenAI API to translate the content
    $translated_content = generate_content_with_openai($prompt);

    // Return the translated content
    return $translated_content;
}

// Function to generate blog content in a specified language
function generate_blog_content_in_language($keywords, $tone, $style, $length, $guidelines, $language) {
    // Generate the blog content in English
    $content = generate_blog_content($keywords, $tone, $style, $length, $guidelines);

    // If the target language is not English, translate the content
    if ($language != 'English') {
        $content = translate_content($content, $language);
    }

    // Return the generated content
    return $content;
}

// Function to generate multiple blog posts in a specified language
function generate_bulk_blog_content_in_language($topics, $tone, $style, $length, $guidelines, $quantity, $language) {
    $blog_posts = array();

    // Loop through the number of posts to generate
    for ($i = 0; $i < $quantity; $i++) {
        // Randomly select a topic
        $topic = $topics[array_rand($topics)];

        // Generate the blog content in the specified language
        $content = generate_blog_content_in_language($topic, $tone, $style, $length, $guidelines, $language);

        // Add the content to the array of blog posts
        $blog_posts[] = $content;
    }

    // Return the array of blog posts
    return $blog_posts;
}
?>
