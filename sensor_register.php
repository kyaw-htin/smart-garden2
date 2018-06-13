
<?php 
session_start();
?>

<html>
<head>
<title>New Sensor Register!!</title>
</head>
<body>

<p>* indicates Required Fields</p>
<form action="sensor_connect.php" method="POST">
<table id="sensor">
		
<tr>
<td> Sensor Name*:</td>
<td>
	<select name="sensor_name">
    <option value="soil_moisture">Soil Moisture Sensor</option>
    <option value="water_level">Water Level Sensor</option>
    <option value="temp_humidity">Temperature & Humidity Sensor</option>

  </select>
 </td>
</tr>

<tr>
<td> Sensor Type*:</td>
<td><input type="text" name="sensor_type" placeholder="Sensor Type"></td>
</tr>

<tr>
		<td>UserName*:</td>
		<td><input type="text" name="username" placeholder="Username"></td>
		</tr>
		
		<tr>
		<td>Password*:</td>
		<td><input type="password" name="password" placeholder="Password"></td>
		</tr>


 <tr>
<td><td><button type="submit"> Add</button></td></td>
</tr>
</table>
</form>
</body>
</html>