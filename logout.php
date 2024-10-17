<?php 
session_start();
if (isset($_SESSION['username']))
{
	session_destroy();
	header("Location:Homepage.html");
}
else{
	header("Location:index.html");
}
?>