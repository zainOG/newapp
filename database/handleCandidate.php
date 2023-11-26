<?php

// Assuming you have a function to handle the candidate data
function handleCandidate($candidate) {
    // Encode the candidate as JSON
    $candidateJson = json_encode(['candidate' => $candidate]);

    // Simulate storing the candidate in a file
    file_put_contents('candidate-storage.json', $candidateJson);

    // Respond to clients with the latest candidate
    respondWithLatestCandidate();
}

function respondWithLatestCandidate() {
    // Simulate reading the latest candidate from the file
    $candidateJson = file_get_contents('candidate-storage.json');

    // Decode the JSON
    $candidateData = json_decode($candidateJson, true);

    // Respond to clients with the latest candidate data
    echo json_encode($candidateData);
}


// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the JSON data from the request body
    $postData = json_decode(file_get_contents('php://input'), true);

    // Check if the required data is present
    if (isset($postData['candidate'])) {
        $candidate = $postData['candidate'];

        // Handle the candidate
        handleCandidate($candidate);

        // Respond with a success message
        echo json_encode(['success' => true, 'message' => 'Candidate received successfully']);
    } else {
        // Respond with an error message if data is missing
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Invalid request']);
    }
} else {
    // Respond with an error for non-POST requests
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed']);
}
