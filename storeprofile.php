<?php
session_start();

include('db.php');

// get userId using username
$username = $_SESSION['username'];
$sqluser = "select * FROM users where userName = '$username'";
$resultuser = mysqli_query($conn, $sqluser);
$rowuser = mysqli_fetch_assoc($resultuser);
$userId = $rowuser['userId'];
// print_r($resultuser);
// print_r($rowuser);

// Retrieve form data
$businessName = $_POST['businessName'];
// print_r($businessName);
$profileBio = $_POST['profileBio'];
$profileEmail = $_POST['profileEmail'];
$socialLink1 = $_POST['socialLink1'];
$socialLink2 = $_POST['socialLink2'];
$socialLink3 = $_POST['socialLink3'];
$contact = $_POST['contact'];
$location = $_POST['location'];
$address = $_POST['address'];
$profilePic = file_get_contents($_FILES['profilePic']['tmp_name']);;

// Perform registration logic and database query
$businessName = $conn->real_escape_string($businessName);
$profileBio = $conn->real_escape_string($profileBio);
$profileEmail = $conn->real_escape_string($profileEmail);
$socialLink1 = $conn->real_escape_string($socialLink1);
$socialLink2 = $conn->real_escape_string($socialLink2);
$socialLink3 = $conn->real_escape_string($socialLink3);
$contact = $conn->real_escape_string($contact);
$location = $conn->real_escape_string($location);
$address = $conn->real_escape_string($address);
$profilePic = $conn->real_escape_string($profilePic);

// sql insert queries
$sql1 = "INSERT INTO business (businessName, socialLink1, socialLink2, socialLink3, contact, location, address)
    VALUES ('$businessName', '$socialLink1', '$socialLink2', '$socialLink3', '$contact', '$location', '$address')";
$sql = "INSERT INTO profile (userId,businessName, profileBio, profileEmail,profilePic) 
    VALUES ('$userId','$businessName','$profileBio','$profileEmail','$profilePic')";

if ($conn->query($sql1) === true) {
  if ($conn->query($sql) === true) {
    $_SESSION['profile'] = true;
    header("Location: profile.php");
    exit;
  } else {
    header("Location: error.php?message=$conn->error");
    exit;
  }
} else {
  header("Location: error.php?message=$conn->error");
  exit;
}
$conn->close();
