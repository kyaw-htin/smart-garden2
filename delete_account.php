<!DOCTYPE html>
<html>
<head>
<title>Delete Account</title>
</head>
<body>
<h1>*Confirm username and password*</h1>

<form action="delete_account_connect.php" method="POST">


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
	   <td><td><button type="submit"> Delete</button></td></td>
	   </tr><br>
	  
	   </table>
</form>

</body>


</html>