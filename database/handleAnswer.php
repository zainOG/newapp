<?php

// Assuming you have a function to handle the answer data
function handleAnswer($answer) {
    // Encode the answer as JSON
    $answerJson = json_encode(['answer' => $answer]);

    // Simulate storing the answer in a file
    file_put_contents('answer-storage.json', $answerJson);

    // Respond to clients with the latest answer
    respondWithLatestAnswer();
}

function respondWithLatestAnswer() {
    // Simulate reading the latest answer from the file
    $answerJson = file_get_contents('answer-storage.json');

    // Decode the JSON
    $answerData = json_decode($answerJson, true);

    // Respond to clients with the latest answer data
    echo json_encode($answerData);
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the JSON data from the request body
    $postData = json_decode(file_get_contents('php://input'), true);

    // Check if the required data is present
    if (isset($postData['answer'])) {
        $answer = $postData['answer'];

        // Handle the answer
        handleAnswer($answer);

        // Respond with a success message
        echo json_encode(['success' => true, 'message' => 'Answer received successfully']);
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
