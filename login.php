<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = $_POST['password'];

  include('db.php');

  try {

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE userName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
      $user = $result->fetch_assoc();

      if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['userName'];
        $_SESSION['userId'] = $user['userId'];

        header("Location: index.php");
        exit;
      } else {
        // Password is not hashed, check if it's in plain text
        if ($user['password'] === $password) {
          // Hash the plain-text password and update the record
          $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
          $stmt = $conn->prepare("UPDATE users SET password = ? WHERE userName = ?");
          $stmt->bind_param("ss", $hashedPassword, $user['userName']);
          $stmt->execute();

          // Successful login and password updated
          $_SESSION['userId'] = $user['id'];
          header("Location: index.php");
          exit;
        } else {
          header("Location: login.html?error=incorrect_password");
          exit;
        }
      }
    } else {
      header("Location: login.html?error=user_not_found");
      exit;
    }
  } catch (Exception $e) {
    // Handle errors gracefully
    echo "Error: " . $e->getMessage();
  }

  $stmt->close();  // Close prepared statement
  $conn->close();
}
