<?php
include 'db.php';

$userId = $_SESSION['userId'];  // Logged-in user
// Fetch all conversations of this user
$sql = "SELECT c.id, u.userName, c.created_at 
        FROM conversations c 
        JOIN users u ON u.userId = c.user_id 
        WHERE c.business_id = ? OR c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $userId, $userId);
$stmt->execute();
$result = $stmt->get_result();
$conversations = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
