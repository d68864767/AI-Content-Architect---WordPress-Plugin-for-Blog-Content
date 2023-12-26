<?php
/*
File Name: settings.php
Description: Handles the settings for the AI Content Architect plugin.
*/

// Prevent direct file access
defined('ABSPATH') or die('No script kiddies please!');

// Add settings menu
add_action('admin_menu', 'ai_content_architect_settings_menu');
function ai_content_architect_settings_menu() {
    add_options_page(
        'AI Content Architect Settings', // page title
        'AI Content Architect', // menu title
        'manage_options', // capability
        'ai-content-architect', // menu slug
        'ai_content_architect_settings_page' // callback function
    );
}

// Settings page
function ai_content_architect_settings_page() {
    ?>
    <div class="wrap">
        <h1>AI Content Architect Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('ai_content_architect_settings');
            do_settings_sections('ai_content_architect');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
add_action('admin_init', 'ai_content_architect_register_settings');
function ai_content_architect_register_settings() {
    register_setting('ai_content_architect_settings', 'openai_api_key');

    add_settings_section(
        'ai_content_architect_settings_section', // id
        'API Settings', // title
        'ai_content_architect_settings_section_callback', // callback function
        'ai_content_architect' // page
    );

    add_settings_field(
        'openai_api_key', // id
        'OpenAI API Key', // title
        'openai_api_key_callback', // callback function
        'ai_content_architect', // page
        'ai_content_architect_settings_section' // section
    );
}

// Settings section callback
function ai_content_architect_settings_section_callback() {
    echo 'Enter your OpenAI API key below.';
}

// API key field callback
function openai_api_key_callback() {
    $openai_api_key = get_option('openai_api_key');
    echo "<input type='text' name='openai_api_key' value='$openai_api_key' />";
}

?>
</h1>