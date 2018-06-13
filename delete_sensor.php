<?php
session_start();
?>
<html>
<head>
<title>Delete sensor!!</title></head>
<body>
<?php 
	include 'connection.php';
	

	$uid=$_SESSION['user_id'];
	$sql="SELECT * from sensor WHERE user_id='$uid'";
	
	$result=$conn->query($sql);
	echo "<center><table border='2'><tr><th>Sensor_id</th>
					<th>User_id</th>
					<th>Sensor_name</th>
					<th>Sensor_type</th>
				</tr>";
	while($row=$result->fetch_array()){
		extract($row);
		echo"<tr><td>{$sensor_id}</td>
				 <td>{$user_id}</td>
		         <td>{$sensor_name}</td>
		         <td>{$sensor_type}</td>
		         <td><form><input type='checkbox[]' name='Sensor' value='$sensor_id'></form>
		          </td></tr>";
	}
	echo"</table> </br></br>";
?>
<form action="delete_sensor_connect.php" method="post">
	<input type="submit" name="delete" value="DELETE">
	</form>
</center>

</body></html>