<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Retrieve form data
  $fullname = trim($_POST['fullname']);
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

  try {
    $stmt = $conn->prepare("INSERT INTO users (fullName, userName, email, password) 
                            VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $username, $email, $hashedPassword);

    if ($stmt->execute()) {
      header("Location: login.html");
      exit;
    } else {
      throw new Exception('Failed to execute statement: ' . $stmt->error);
    }
  } catch (Exception $e) {
    // Handle errors gracefully and show the error message
    echo "Error: " . $e->getMessage();
  }

  $stmt->close();
  $conn->close();
}
