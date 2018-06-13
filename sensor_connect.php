<?php
session_start();
include 'connection.php';

$uid=$_SESSION['user_id'];
$sensor_name = $_POST['sensor_name'];
$sensor_type = $_POST['sensor_type'];
$username = $_POST['username'];
$password = $_POST['password'];


$sql = "INSERT INTO sensor (user_id,sensor_name,sensor_type,username,password) 
VALUES ('$uid','$sensor_name','$sensor_type','$username', '$password')";

$result = $conn->query($sql);


if ($result === TRUE )
{
	echo '<form action="showUserSensor.php" method="POST">';
	echo '<input type="submit" name="submit" value="Show Sensor List">';
}

else {
	echo "Registration Failure";
}
?>
