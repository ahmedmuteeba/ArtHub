<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  include('db.php');

  // Retrieve form data and apply basic sanitization
  $fullname = trim($_POST['fullname']);
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

  try {
    $stmt = $conn->prepare("INSERT INTO users (fullName, userName, email, password) VALUES (?, ?, ?, ?)");

    if ($stmt === false) {
      throw new Exception('Failed to prepare statement: ' . $conn->error);
    }

    $stmt->bind_param("ssss", $fullname, $username, $email, $hashedPassword);

    // Execute the statement
    if ($stmt->execute()) {

      // On successful registration, redirect to the login page
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
