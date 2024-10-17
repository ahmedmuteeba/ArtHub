<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required form fields are provided
    if (isset($_POST['artName'], $_POST['artDetails'], $_POST['artDimensions'], $_POST['artPrice'], $_POST['category'], $_FILES['artPicture1'], $_FILES['artPicture2'], $_FILES['artPicture3'])) {
        // Retrieve form data
        $artName = $_POST['artName'];
        $artDetails = $_POST['artDetails'];
        $artDimensions = $_POST['artDimensions'];
        $artPrice = $_POST['artPrice'];
        $category = $_POST['category'];
        $fileData1 = file_get_contents($_FILES['artPicture1']['tmp_name']);
        $fileData2 = file_get_contents($_FILES['artPicture2']['tmp_name']);
        $fileData3 = file_get_contents($_FILES['artPicture3']['tmp_name']);
        $userId = $_SESSION['userId'];
        $artRating=rand(1,5);
        print_r($userId);
       

        // Perform necessary validations and sanitization on the form data

        // Connect to the database
        $servername = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName = 'project';

        $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Insert the artwork into the database
        $insertStmt = $conn->prepare("INSERT INTO artwork (categoryId,userId,artName, artDetails, artDimensions, artPrice, artPicture1, artPicture2, artPicture3,artRating ) VALUES (?,?,?, ?, ?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("iisssssssi", $category,$userId, $artName, $artDetails, $artDimensions, $artPrice, $fileData1, $fileData2, $fileData3,$artRating);
        $insertStmt->execute();

        // Check if the insertion was successful
        if ($insertStmt->affected_rows > 0) {
            echo 'Artwork added successfully!';
        } else {
            echo 'Error adding artwork.';
        }

        $insertStmt->close();
        $conn->close();
    } else {
        echo 'Please provide all required form fields.';
    }
}
?>
