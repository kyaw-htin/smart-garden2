<?php 
  session_start();
  
  ?>


<!DOCTYPE html>
<html>
<head>
<title>Log In!!</title>
</head>
<body>



<form action="login_connect.php" method="POST">

<table id="login">
		<tr>
		<td>UserName:</td>
		<td><input type="text" name="username" placeholder="Username"></td>
		</tr>
		
		<tr>
		<td>Password:</td>
		<td><input type="password" name="password" placeholder="Password"></td>
		</tr>
		<br>
		
		<tr>
		<td><td><input type="submit" name="submit" value="Submit"></td></td>
		</tr>
		</table>  
</form>

</body>
</html>

