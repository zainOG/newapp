<?php

// Assuming you have a function to handle the offer data
function handleOffer($offer) {
    // Encode the offer as JSON
    $offerJson = json_encode(['offer' => $offer]);

    // Simulate storing the offer in a file
    file_put_contents('offer-storage.json', $offerJson);

    // Respond to clients with the latest offer
    respondWithLatestOffer();
}

function respondWithLatestOffer() {
    // Simulate reading the latest offer from the file
    $offerJson = file_get_contents('offer-storage.json');

    // Decode the JSON
    $offerData = json_decode($offerJson, true);

    // Respond to clients with the latest offer data
    echo json_encode($offerData);
}


// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the JSON data from the request body
    $postData = json_decode(file_get_contents('php://input'), true);

    // Check if the required data is present
    if (isset($postData['offer'])) {
        $offer = $postData['offer'];

        // Handle the offer
        handleOffer($offer);

        // Respond with a success message
        echo json_encode(['success' => true, 'message' => 'Offer received successfully']);
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
