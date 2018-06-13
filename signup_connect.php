<?php
session_start();
include 'connection.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
 
echo "<br>";

$sql = "INSERT INTO user_info (fname,lname,email,username,password) 
VALUES ('$fname','$lname','$email', '$username', '$password')";

$result = $conn->query($sql);

if ($result === TRUE )
{
	echo "Your registration is successful!!";
	echo "<br>";
	echo "<br>";
	echo '<form action="login.php" method="POST">';
	echo '<button type="submit"> Log In</button>';
}

else{
	echo "Registration failure!!";

}


//header("Location: welcome.html");
?>
