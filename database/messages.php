<?php
include('./db.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'getMessages') {
    echo json_encode(getMessages());
} elseif ($action === 'saveMessage') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data) {
        saveMessage($data['type'], $data['message']);
    }
} else {
    // Handle other actions or return an error response
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid action']);
}

function getMessages() {
    global $conn;
    $messages = [];
    
    // Fetch messages from the database
    $query = "SELECT * FROM chatmessages";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
        mysqli_free_result($result);
    }

    return $messages;
}

function saveMessage($type, $message) {
    global $conn;

    // Save message to the database
    $type = mysqli_real_escape_string($conn, $type);
    $message = mysqli_real_escape_string($conn, $message);

    $query = "INSERT INTO chatmessages (type, message) VALUES ('$type', '$message')";
    mysqli_query($conn, $query);
}
?>