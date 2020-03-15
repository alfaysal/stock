<?php

	include('server.php');
	include('session_security.php');





		function load_category(){
		$connect = mysqli_connect('localhost','root','','rps');
		$output = '';
		$sql = "SELECT * from category order by category_name";
		$result  = mysqli_query($connect,$sql);
		while($row=mysqli_fetch_array($result)){
			$output .= '<option value="'.$row["category_id"].'">'.$row["category_name"].'</option>';
		}
		return $output;
	}

		function fill_unit_select_box_lot(){ 
			$connect = mysqli_connect('localhost','root','','rps');
			$output = '';
		 	$query = "SELECT lot FROM pro_recive WHERE quantity>0";
			$result  = mysqli_query($connect,$query);
			while($row=mysqli_fetch_array($result)){
			$output .= '<option value="'.$row["lot"].'">'.$row["lot"].'</option>';
		}
		return $output;
		}




	if(isset($_GET['giv_id'])){
	$temp_giv_id = $_GET['giv_id'];	
	}
	
	$sql = "SELECT * FROM pro_given_temporary1 WHERE temp_giv_id='$temp_giv_id'";
	$run = mysqli_query($db_con,$sql);
   while($user = mysqli_fetch_assoc($run)){
   $zone_code =$user['zone_code'];
	$brance_code= $user['brance_code'];
	$category_id= $user['category_id'];
	$product_id= $user['product_id'];
	$lot = $user['lot'];
	$emp_id =  $user['emp_id'];
	$chalan= $user['chalan'];
	$hchalan = $user['hchalan'];
	$ref_no = $user['ref_no'];
	$dem_quan = $user['dem_quan'];
	$quantity = $user['quantity'];
	$price = $user['price'];
	$unit_price = $user['unit_price'];
	$give_date = $user['give_date'];
	$given_by = $user['given_by'];
	$advice = $user['advice'];

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
						<h2><i class="halflings-icon edit"></i><span class="break"></span>edit given</h2>
						<div class="box-icon">
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<table>
						<table>
					   		<form action="" method="POST">
					   			<tr>
						   			<td>
						   				ZONE:<select name="zone_code" id="zone" class="form-control zone_code"><option value="<?php echo $zone_code; ?>">
						   				<?php
						   					$sql_zone = "SELECT zone_name from zone_info where zone_code='$zone_code'";
						   					$run_zone = mysqli_query($db_con,$sql_zone);
						   					$result_zone = mysqli_fetch_assoc($run_zone);
						   					$zone_name = $result_zone['zone_name'];
						   					echo $zone_name;

						   				 ?></option>
						   				</select>
						   			</td>
						   			<td>
						   				brance:<select name="brance_code" id="brance" class="form-control brance_code"><option value="<?php echo $brance_code; ?>">
						   				<?php
						   					$sql_brance = "SELECT brance_name from brance_info where brance_code='$brance_code'";
						   					$run_brance = mysqli_query($db_con,$sql_brance);
						   					$result_brance = mysqli_fetch_assoc($run_brance);
						   					$brance_name = $result_brance['brance_name'];
						   					echo $brance_name;

						   				 ?>
						   				</option></select>
						   			</td>
						   			<td>
						   				category:<select name="category_id" id="category" class="form-control category_id"><option value="">select category</option>
						   					<?php echo load_category(); ?>
						   				</select>
						   			</td>
						   			<td>
						   				product:<select id="product" name="product_id" class="form-control product_id"><option value="">Select product</option></select>
						   			</td>
					   			</tr>
					   			<tr>
						   			<td>
						   				lot:<select name="lot" class="form-control lot"><option value="">Select lot</option>
						   					<?php echo fill_unit_select_box_lot() ; ?>
						   				</select>
						   			</td>
						   			<td>
						   				employee:<select name="emp_id" class="form-control emp_id">
						   					<option value="<?php echo $emp_id ?>">
						   				<?php
						   					$sql_emp = "SELECT emp_name from emp_table where emp_id='$emp_id'";
						   					$run_emp = mysqli_query($db_con,$sql_emp);
						   					$result_emp = mysqli_fetch_assoc($run_emp);
						   					$emp_name = $result_emp['emp_name'];
						   					echo $emp_name;

						   				 ?>
						   				</option>
						   				</select>
						   			</td>
						   			<td>
						   				reference no:<input type="text" name="ref_no" class="form-control ref_no" value="<?php echo $ref_no ?>" />
						   			</td>
						   			<td>
						   				chalan:<input type="text" name="chalan" value="<?php echo $chalan; ?>" class="form-control chalan" />
						   			</td>
					   			</tr>
					   			<td>
					   				h/ochalan:<input type="text" name="hchalan" class="form-control hchalan" />
					   			</td>
					   			<td>
					   				demand:<input type="text" name="dem_quan" class="form-control dem_quan" />
					   			</td>
						   			<td>
						   				quantity:<input type="text" id="quantity" oninput="calculate()" name="quantity" class="form-control quantity" />
						   			</td>
						   			<td>
						   				unit <input type="text" name="unit_price" id="unit_price" oninput="calculate()" class="form-control unit_price" />
						   			</td>
						   			
					   			<tr>
						   			<td>
						   				total:<input type="text" id="total" value="calculate()" name="price" class="form-control price" />
						   			</td>
						   			<td>
						   				give date:<input type="date" name="give_date" class="form-control give_date" />
						   			</td>
						   			<td>
						   				advice:<input type="text" name="advice" class="form-control advice" value="<?php echo $advice ?>" />
						   			</td>
					   			</tr>
					   			<td>
					   				
					   			</td>
					   			<td>
					   				<button style="float: right" type="submit" name="further_submit_given" class="btn btn-success btn-sm remove">add</button>
					   				
					   			</td>
					   			<td></td>
					   			<td>
					   				<a href="reportchalan.php" style="background: #5b81de;padding: 8px;color: white;float: left;">Get chalan</a>
					   			</td>

					   			<!--
					   			<td>
					   				<a href="#" style="background: #5b81de;padding: 8px;color: white;float: left; visibility: hidden;" onclick="further_submit()"> add more</a>
					   			</td>
					   		-->
					   		</form>
					   </table>
					</table>
				</div><!--/span-->

			</div>
				

			</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<?php include('footer.php'); ?>

