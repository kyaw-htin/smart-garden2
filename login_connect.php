<?php
session_start(); 
include 'connection.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user_info WHERE username='$username' AND password='$password' ";
$sql1= "SELECT * FROM sensor WHERE username='$username' AND password='$password' ";
$sql2="SELECT user_id FROM user_info WHERE username='$username' AND password='$password' ";

$result = $conn->query($sql);
$result1 = $conn->query($sql1);
$result2= $conn->query($sql2);

$row = $result->fetch_assoc();
$row1= $result1->fetch_assoc();
$row2= $result2->fetch_assoc();

$_SESSION['user_id']=$row2['user_id'];

if (!$row) {
	echo "Your username or password is wrong!!";
	}
	
else {
		
	if (isset($row['user_id']))
	{
	   echo "Your personal ID is ";
	  
	   echo $row['user_id'];
		echo "<br>";
		echo "<br>";
		echo "<br>";
		
		echo "<center>";
		echo "$username's sensor list";
		echo "</center>";
		echo "<br>";
		echo "<br>";
		echo "<center><table border='2'><tr><th>Sensor_id</th>
					<th>User_id</th>
					<th>Sensor_name</th>
					<th>Sensor_type</th>
				</tr>";
		
		while($row1=$result1->fetch_array()){
			extract($row1);
			echo"<tr><td>{$sensor_id}</td>
			<td>{$user_id}</td>
			<td>{$sensor_name}</td>
			<td>{$sensor_type}</td>
			
			</tr>";
		}
		echo"</table> </br></br>";
	    
		echo
		'
		 <a href="delete_account.php">Delete Account</a><br>
		 <a href="sensor_register.php">Add New Sensor</a><br>
		 <a href="delete_sensor.php">Delete Sensor</a></center>
				';
	}

}
?>
		
		
	
	
