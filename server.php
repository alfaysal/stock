<?php

	
	session_start();
	$user_id="";
	$user_name = "";
	$password = "";
	$user_status="";
	$type="";
	$zone_code="";
	$user_address="";
	$user_mobile="";
	$designation="";
	$category_name="";
	$category_description="";
	$error = array();
	$db_con = mysqli_connect('localhost','root','','rps');

	if(isset($_POST['submit'])){
		$user_id = mysqli_real_escape_string($db_con,$_POST['user_id']);
		$user_name = mysqli_real_escape_string($db_con,$_POST['user_name']);
		$password = mysqli_real_escape_string($db_con,$_POST['password']);
		$user_status = mysqli_real_escape_string($db_con,$_POST['user_status']);
		$type= mysqli_real_escape_string($db_con,$_POST['type']);
		$zone_code = mysqli_real_escape_string($db_con,$_POST['zone_code']);
		$user_address = mysqli_real_escape_string($db_con,$_POST['user_address']);
		$user_mobile = mysqli_real_escape_string($db_con,$_POST['user_mobile']);
		$designation = mysqli_real_escape_string($db_con,$_POST['designation']);

		if(empty($user_id)){
			array_push($error,"user id must be required");
		}else if(empty($user_name)){
			array_push($error,"username should not empty");
		}else if(empty($password)){
			array_push($error,"password must be required");
		}else if(empty($user_status)){
			array_push($error,"user status should not empty");
		}else if(empty($type)){
			array_push($error,"type should not empty");
		}else if(empty($zone_code)){
			array_push($error,"zone code should not empty");
		}else if(empty($user_address)){
			array_push($error,"user address should not empty");
		}else if(empty($user_mobile)){
			array_push($error,"user mobile number should not empty");
		}else if(empty($designation)){
			array_push($error,"user designation should not empty");
		}

		if(count($error) == 0){
			$passwordmd5 = $password;

			$sql="INSERT INTO `user_table2` (`user_id`, `user_name`, `password`, `user_status`, `type`, `zone_code`, `user_address`, `user_mobile`, `designation`, `created_by`) VALUES ('$user_id', '$user_name', '$passwordmd5', '$user_status', '$type', '$zone_code', '$user_address', '$user_mobile', '$designation', '".$_SESSION["user_name"]."')";
			//$run = mysqli_query($db_con,$sql);
			if(mysqli_query($db_con,$sql)){
				header('Location:user_details.php');
			}
			else
			{
				echo "problem";
			}
			
		}

	}

	if(isset($_POST['logbutton'])){
		$user_id = mysqli_real_escape_string($db_con,$_POST['user_id']);
		$password = mysqli_real_escape_string($db_con,$_POST['password']);

		if(empty($user_id)){
			array_push($error,"user id must be required");
		}else if(empty($password)){
			array_push($error,"password must be required");
		}

		if(count($error)==0){
			$passwordmd5 = $password;
			$sql = "SELECT * FROM user_table2 WHERE user_id ='".$user_id."' AND password='$passwordmd5' AND user_status='1'";
			$run = mysqli_query($db_con,$sql);
			$result1 = mysqli_num_rows($run);

			if($result1 >0){
				while($row = mysqli_fetch_assoc($run)){
					$user_id=$row["user_id"];
					$user_name = $row["user_name"];
					$zone_code= $row["zone_code"];
					$type = $row['type'];
				}
				//echo $user_id.$user_name.$type;
				$_SESSION["user_id"] = $user_id;
				$_SESSION["zone_code"] = $zone_code;
				$_SESSION["user_name"] = $user_name;
				$_SESSION["type"] =$type;
				header('Location:home.php');

			}else {
				array_push($error,"user name or password is not correct");
			}
			
		}

	}

	if(isset($_POST['submit_cat'])){
		$category_name = mysqli_real_escape_string($db_con,$_POST['category_name']);
		$category_description = mysqli_real_escape_string($db_con,$_POST['category_description']);

		if(empty($category_name)){
			array_push($error,'category name must be required');
		}else if(empty($category_description)){
			array_push($error,'category description must be required');
		}

		if(count($error) == 0){
			$sql = "INSERT INTO category (category_name,category_description) VALUES ('$category_name','$category_description')";
			if(mysqli_query($db_con,$sql)){
				header('Location:create_category.php');
			}
			else
			{
				echo "problem";
			}
		}

	}

	
	
 ?>