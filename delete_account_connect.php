<?php

session_start();
include 'connection.php';

$uid=$_SESSION['user_id'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "DELETE FROM user_info WHERE username='$username' AND password='$password'";

$result = $conn->query($sql);

if ($result === TRUE) {
	echo "Account deleted successfully";
	echo "<br>";
} else {
	echo "Error deleting account: " . $conn->error;
}

$sql1 = "DELETE FROM sensor WHERE username='$username' AND password='$password'";
$result1 = $conn->query($sql1);

if ($result1 === TRUE) {
	echo "All sensor data deleted successfully";
} else {
	echo "Error deleting data: " . $conn->error;
}


header("Location: login.php");

?>