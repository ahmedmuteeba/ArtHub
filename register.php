<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // TODO: Perform registration logic and database query

  // Example code for connecting to MySQL and inserting user data
  $servername = 'localhost';
  $dbUsername = 'root';
  $dbPassword = '';
  $dbName = 'project';

  $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  // Sanitize user input to prevent SQL injection
  $fullname = $conn->real_escape_string($fullname);
  $username = $conn->real_escape_string($username);
  $email = $conn->real_escape_string($email);
  $password = $conn->real_escape_string($password);

  // Perform database query
  $sql = "INSERT INTO users (fullName, userName, email, password) VALUES ('$fullname','$username', '$email', '$password')";
  
  if ($conn->query($sql) === true) {
      header("Location: login.html");
  } else {
    echo 'Error: ' . $sql . '<br>' . $conn->error;
  }
  

  $conn->close();
}
?>