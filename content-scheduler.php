<?php
/*
File Name: content-scheduler.php
Description: Schedules the publication of generated blog posts.
*/

// Prevent direct file access
defined('ABSPATH') or die('No script kiddies please!');

// Function to schedule a blog post
function schedule_blog_post($post_id, $schedule_time) {
    // Check if the post exists
    if (get_post_status($post_id) === false) {
        return false;
    }

    // Schedule the post
    wp_schedule_single_event($schedule_time, 'publish_future_post', array($post_id));

    // Update the post status to future
    $post_data = array(
        'ID' => $post_id,
        'post_status' => 'future',
        'post_date' => date('Y-m-d H:i:s', $schedule_time),
        'post_date_gmt' => gmdate('Y-m-d H:i:s', $schedule_time)
    );
    wp_update_post($post_data);

    return true;
}

// Function to schedule multiple blog posts
function schedule_bulk_blog_posts($post_ids, $schedule_times) {
    $results = array();

    // Loop through the post IDs
    foreach ($post_ids as $index => $post_id) {
        // Schedule the post
        $result = schedule_blog_post($post_id, $schedule_times[$index]);

        // Add the result to the array
        $results[] = $result;
    }

    return $results;
}

?>
