<?php
/*
File Name: openai-api.php
Description: Integrates with OpenAI's language models for content generation.
*/

// Prevent direct file access
defined('ABSPATH') or die('No script kiddies please!');

// OpenAI API Key
define('OPENAI_API_KEY', get_option('openai_api_key'));

// OpenAI API URL
define('OPENAI_API_URL', 'https://api.openai.com/v1/engines/davinci-codex/completions');

// Function to generate content using OpenAI API
function generate_content_with_openai($prompt, $max_tokens = 500, $temperature = 0.5) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, OPENAI_API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
        'prompt' => $prompt,
        'max_tokens' => $max_tokens,
        'temperature' => $temperature
    )));

    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . OPENAI_API_KEY;
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    $result = json_decode($result, true);

    return $result['choices'][0]['text'];
}

?>
