<?php

/**
 * Task Name: backend-stage-one-task
 * Programming Lanuage used: PHP
 * Student Name: Rilwanu Isyaku
 * GitHub Profile: https://github.com/ridwanishaq
 * Date: 10-September-2023
 * Endpoint Example: ?slack_name=HNGx Internship&track=backend
 * 
 * 
 */

// Function to get the current UTC time.
function getCurrentUtcTime() {
    // Define the allowed time window in seconds (2 minutes).
    $allowedTimeWindow = 120;

    // Calculate the current UTC time.
    $currentUtcTime = gmdate('Y-m-d\TH:i:s\Z');

    // Convert the current time to a Unix timestamp.
    $currentTimestamp = strtotime($currentUtcTime);

    // Check if the current time is within the allowed time window.
    if (abs(time() - $currentTimestamp) <= $allowedTimeWindow) {
        return $currentUtcTime; // Time is within the allowed window.
    } else {
        http_response_code(400); // Bad Request
        exit('Current UTC time is outside the allowed time window.');
    }
}

// Get query parameters from the URL.
$slackName = isset($_GET['slack_name']) ? $_GET['slack_name'] : '';
$track = isset($_GET['track']) ? $_GET['track'] : '';

// Validate the track parameter.
$validTracks = ['backend']; // Can add other valid tracks if needed.
if (!in_array($track, $validTracks)) {
    http_response_code(400); // Bad Request
    exit('Invalid track parameter.');
}

// Define the response data.
$responseData = [
    'slack_name' => $slackName,
    'current_day' => date('l'), // Current day of the week.
    'utc_time' => getCurrentUtcTime(),
    'track' => $track,
    'github_file_url' => 'https://github.com/ridwanishaq/backend-stage-one-task/blob/master/index.php',
    'github_repo_url' => 'https://github.com/ridwanishaq/backend-stage-one-task',
    'status_code' => 200,
];

// Set response headers to indicate JSON content.
header('Content-Type: application/json');

// Output the JSON response.
echo json_encode($responseData);
