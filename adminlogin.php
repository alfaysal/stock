<?php

	include('server.php');

 ?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>ADMIN login system</title>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="header"> 
		<h1>ADMIN LOGIN FORM</h1>
	</div>

	<form action="adminlogin.php" method="POST">
	
		<?php include('error.php') ?>
		<div class="input">
			<label>ID:</label>
			<input type="text" name="user_id" />
		</div>
		<div class="input">
			<label>PASSWORD:</label>
			<input type="password" name="password" />
		</div>
		<div class="input">
			<button type="submit" name="logbutton" class="button">LOGIN</button>
		</div>
	</form>
	
</body>
</html>