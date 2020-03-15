<?php

	include('server.php');
	include('session_security.php');
	if(isset($_GET['id'])){
	$user_id = $_GET['id'];	
	}
	
	$sql = "SELECT * FROM user_table2 WHERE user_id='$user_id'";
	$run = mysqli_query($db_con,$sql);
   while($user = mysqli_fetch_assoc($run)){
   $user_id =$user['user_id'];
	$user_name= $user['user_name'];
	$password= $user['password'];
	$user_status= $user['user_status'];
	$type = $user['type'];
	$zone_code =  $user['zone_code'];
	$user_address= $user['user_address'];
	$user_mobile = $user['user_mobile'];
	$designation = $user['designation'];
	$created_by = $user['created_by'];

   }
							  		
	
	
	
	
 ?>
	<?php

if(isset($_POST['update_user'])){
	$user_id_new = $_GET['update_form'];
		$user_id_n = mysqli_real_escape_string($db_con,$_POST['user_id_n']);
		$user_name_n = mysqli_real_escape_string($db_con,$_POST['user_name_n']);
		$password_n = mysqli_real_escape_string($db_con,$_POST['password_n']);
		$user_status_n = mysqli_real_escape_string($db_con,$_POST['user_status_n']);
		$type_n= mysqli_real_escape_string($db_con,$_POST['type_n']);
		$zone_code_n = mysqli_real_escape_string($db_con,$_POST['zone_code_n']);
		$user_address_n = mysqli_real_escape_string($db_con,$_POST['user_address_n']);
		$user_mobile_n = mysqli_real_escape_string($db_con,$_POST['user_mobile_n']);
		$designation_n = mysqli_real_escape_string($db_con,$_POST['designation_n']);
		$created_by_n = $_SESSION["user_name"];

		/*$sql = "UPDATE user_table2 SET user_id='$user[user_id]',user_name='$user[user_name]',password='$user[password]',user_status='$user[user_status]',type='$user[type]',zone_code='$user[zone_code]',user_address='$user[user_address]',user_mobile='$user[user_mobile]',designation='$user[designation]',created_by='$user[created_by]' WHERE user_id=$user_id";*/

		$sql = "UPDATE user_table2 SET user_id='$user_id_n',user_name='$user_name_n',password='$password_n',user_status='$user_status_n',type='$type_n',zone_code='$zone_code_n',user_address='$user_address_n',user_mobile='$user_mobile_n',designation='$designation_n',created_by='$created_by_n' WHERE user_id=$user_id_new";

		$run = mysqli_query($db_con,$sql);
		if($run){
			header('Location:user_details.php');
		}else{
			echo "prbolem";
		}
	}
	
	

	 ?>


<?php include('navbar.php'); ?>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
		<?php include('sidebar.php'); ?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
				<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Create User</h2>
						<div class="box-icon">
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="edit_user.php?update_form=<?php echo $user_id; ?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">User Id </label>
							  <div class="controls">
								<input type="text" name="user_id_n" value="<?php echo $user_id; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">User Name </label>
							  <div class="controls">
								<input type="text" name="user_name_n" value="<?php echo $user_name; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Password </label>
							  <div class="controls">
								<input type="password" name="password_n" value="<?php echo $password; ?>" >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">User Status</label>
							  <div class="controls">
								  <select class="form-control" id="sel1" name="user_status_n">
								  	<option><?php echo $user_status; ?></option>
								    <option value="1">Active</option>
								    <option value="2">Deactive</option>
								  </select>
								</div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">User type</label>
							  <div class="controls">
								  <select class="form-control" id="sel1" name="type_n">
								  	<option><?php echo $type; ?></option>
								    <option value="1">Admin</option>
								    <option value="2">User</option>
								  </select>
								</div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Zone Name</label>
							  <div class="controls">
							  		<?php

										$db_con = mysqli_connect('localhost', 'root', '','rps');

										$sql = "SELECT * FROM zone_info";
										$result1 = mysqli_query($db_con,$sql);

										echo "<select name='zone_code_n'>";
									?>
											<option><?php echo $zone_code; ?></option>
									<?php
										while ($row = mysqli_fetch_array($result1)) {
												$zone_id = $row['zone_id'];
												$zone_code = $row['zone_code'];
												$zone_name = $row['zone_name'];
										    echo "<option value='" . $row['zone_code'] . "'>" . $row['zone_name'] . "</option>";
										}
										echo "</select>";

									?>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">User Address</label>
							  <div class="controls">
								<input type="text" name="user_address_n" value="<?php echo $user_address; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">User mobile</label>
							  <div class="controls">
								<input type="text" name="user_mobile_n" value="<?php echo $user_mobile; ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">User Designation</label>
							  <div class="controls">
								<input type="text" name="designation_n" value="<?php echo $designation; ?>">
							  </div>
							</div>

							<button type="submit" name="update_user" class="btn btn-primary">Update
							user</button>
							
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div>
				

			</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<?php include('footer.php'); ?>

