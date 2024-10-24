<?php
session_start();
include 'db.php';  // Assuming db.php initializes $conn (the database connection)

// Sanitize input
$business_id = isset($_GET['businessId']) ? intval($_GET['businessId']) : null;
$conversation_id = isset($_GET['conversationId']) ? intval($_GET['conversationId']) : null;
$userId = $_SESSION['userId'];  // Assuming userId is stored in session

// Ensure either businessId or conversationId is provided
if (!$business_id && !$conversation_id) {
    echo json_encode(['error' => 'Neither businessId nor conversationId provided.']);
    exit;
}

// Fetch messages based on conversationId (prioritize this if available)
if ($conversation_id) {
    // Fetch all messages in the conversation
    $stmt = $conn->prepare("SELECT sender_id, message, created_at FROM messages WHERE conversation_id = ? ORDER BY created_at ASC");
    $stmt->bind_param("i", $conversation_id);
    $stmt->execute();
    $messageResults = $stmt->get_result();

    $messages = [];
    while ($row = $messageResults->fetch_assoc()) {
        $messages[] = [
            'sender' => ($row['sender_id'] == $userId) ? 'user' : 'artist',
            'text' => $row['message']
        ];
    }

    echo json_encode(['messages' => $messages]);
    $stmt->close();

} elseif ($business_id) {
    // Check if a conversation exists for this business
    $stmt = $conn->prepare("SELECT id FROM conversations WHERE user_id = ? AND business_id = ?");
    $stmt->bind_param("ii", $userId, $business_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Conversation found, fetch its messages
        $conversation = $result->fetch_assoc();
        $conversation_id = $conversation['id'];

        $stmt = $conn->prepare("SELECT sender_id, message, created_at FROM messages WHERE conversation_id = ? ORDER BY created_at ASC");
        $stmt->bind_param("i", $conversation_id);
        $stmt->execute();
        $messageResults = $stmt->get_result();

        $messages = [];
        while ($row = $messageResults->fetch_assoc()) {
            $messages[] = [
                'sender' => ($row['sender_id'] == $userId) ? 'user' : 'artist',
                'text' => $row['message']
            ];
        }

        echo json_encode(['messages' => $messages]);
        $stmt->close();
    } else {
        echo json_encode(['error' => 'No conversation found for this business ID.']);
    }
}

// Close the database connection
$conn->close();
?>
