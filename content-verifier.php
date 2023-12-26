<?php
/*
File Name: content-verifier.php
Description: Verifies the uniqueness of the generated blog content.
*/

// Prevent direct file access
defined('ABSPATH') or die('No script kiddies please!');

// Include OpenAI API file
require_once plugin_dir_path(__FILE__) . 'openai-api.php';

// Function to verify the uniqueness of the content
function verify_content_uniqueness($content) {
    // Get all posts from the WordPress database
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );
    $all_posts = get_posts($args);

    // Loop through each post
    foreach ($all_posts as $post) {
        // If the content is found in any post, return false
        if (strpos($post->post_content, $content) !== false) {
            return false;
        }
    }

    // If the content is not found in any post, return true
    return true;
}

// Function to verify the uniqueness of multiple blog posts
function verify_bulk_content_uniqueness($blog_posts) {
    // Loop through each blog post
    foreach ($blog_posts as $post) {
        // If the content is not unique, return false
        if (!verify_content_uniqueness($post)) {
            return false;
        }
    }

    // If all blog posts are unique, return true
    return true;
}

?>
