<?php
	
	$user_id = $_SESSION["user_id"];

	if($user_id == NULL){
	header('Location:adminlogin.php');
	}

 ?>