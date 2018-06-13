 <?php

$conn = mysqli_connect("localhost","root","","smart_garden");

if (!$conn) {
    die("Connection failed!!: " . mysqli_connect_error());
}
echo "Connected successfully!!";
?> 