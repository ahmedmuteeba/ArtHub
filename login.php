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

                $stmt = $conn->prepare("SELECT * FROM profile WHERE userId = ?");
                $stmt->bind_param("i", $user['userId']);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $_SESSION['profile'] = true;
                } else {
                    $_SESSION['profile'] = false;
                }

                header("Location: index.php");
                exit;
            } else {
                header("Location: error.php?message=incorrect_password");
                exit;
            }
        } else {
            header("Location: error.php?message=user_not_found");
            exit;
        }
    } catch (Exception $e) {
        header("Location: error.php?message=" . urlencode($e->getMessage()));
        exit;
    }

    $stmt->close();  // Close prepared statement
    $conn->close();
}
