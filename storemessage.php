<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['userId'];
    $businessId = $_POST['businessId'];
    $conversationId = $_POST['conversationId'];
    $message = trim($_POST['message']);

    if (!empty($message)) {
        if (!$conversationId) {
            $stmt = $conn->prepare("SELECT id FROM conversations WHERE user_id = ? AND business_id = ?");
            $stmt->bind_param("ii", $userId, $businessId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $conversation = $result->fetch_assoc();
                $conversationId = $conversation['id'];
            } else {
                $stmt = $conn->prepare("INSERT INTO conversations (user_id, business_id) VALUES (?, ?)");
                $stmt->bind_param("ii", $userId, $businessId);
                $stmt->execute();
                $conversationId = $stmt->insert_id;
            }
        }
        $stmt = $conn->prepare("INSERT INTO messages (conversation_id, sender_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $conversationId, $userId, $message);

        if ($stmt->execute()) {
            header("Location: messages.php?conversationId=$conversationId");
            exit;
        } else {
            echo "Failed to send the message.";
        }

        $stmt->close();
    } else {
        echo "Message cannot be empty.";
    }

    $conn->close();
} else {
    // If not POST request, handle it here (optional)
    echo "Invalid request.";
}
