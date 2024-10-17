<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $username = $_POST['username'];
  $password = $_POST['password'];

//   TODO: Perform registration logic and database query

  // Example code for connecting to MySQL and inserting user data
  $servername = 'localhost';
  $dbUsername = 'root';
  $dbPassword = '';
  $dbName = 'project';

  $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
  if (!$conn) {
    die();
  }

  // Sanitize user input to prevent SQL injection
  $username = $conn->real_escape_string($username);
  $password = $conn->real_escape_string($password);

// Perform database query
  $sql = "SELECT * FROM users WHERE userName='$username' AND password='$password'";
  $result = $conn->query($sql);


  if ($result->num_rows > 0) {
    // User authenticated
    $user = $result->fetch_assoc();
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
    $_SESSION['userId'] = $user['userId'];
    header("Location: index.html");

  } else {
    // Invalid credentials
    header("Location: login.html");
  }

  $conn->close();
}
?>