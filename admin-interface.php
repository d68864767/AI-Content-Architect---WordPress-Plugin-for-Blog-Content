<?php
/*
File Name: admin-interface.php
Description: Provides a user-friendly interface for the AI Content Architect plugin.
*/

// Prevent direct file access
defined('ABSPATH') or die('No script kiddies please!');

// Add admin menu
add_action('admin_menu', 'ai_content_architect_admin_menu');
function ai_content_architect_admin_menu() {
    add_menu_page(
        'AI Content Architect', // page title
        'AI Content Architect', // menu title
        'manage_options', // capability
        'ai-content-architect', // menu slug
        'ai_content_architect_admin_page', // callback function
        'dashicons-admin-generic', // icon URL
        3 // position
    );
}

// Admin page
function ai_content_architect_admin_page() {
    ?>
    <div class="wrap">
        <h1>AI Content Architect</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('ai_content_architect_settings');
            do_settings_sections('ai-content-architect');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
add_action('admin_init', 'ai_content_architect_register_admin_settings');
function ai_content_architect_register_admin_settings() {
    register_setting('ai_content_architect_settings', 'openai_api_key');

    add_settings_section(
        'ai_content_architect_settings_section', // id
        'Settings', // title
        'ai_content_architect_settings_section_callback', // callback
        'ai-content-architect' // page
    );

    add_settings_field(
        'openai_api_key', // id
        'OpenAI API Key', // title
        'openai_api_key_callback', // callback
        'ai-content-architect', // page
        'ai_content_architect_settings_section' // section
    );
}

// Settings section callback
function ai_content_architect_settings_section_callback() {
    echo '<p>Enter your OpenAI API key below:</p>';
}

// OpenAI API key callback
function openai_api_key_callback() {
    $openai_api_key = get_option('openai_api_key');
    echo "<input type='text' name='openai_api_key' value='$openai_api_key' />";
}
?>
</p></h1>