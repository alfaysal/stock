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


		


			$sql = "SELECT * FROM pro_recive_temporary where temp_rcv_id='".$_SESSION["last_rcv_id"]."'";
			if($run = mysqli_query($db_con,$sql)){
				$result = mysqli_fetch_assoc($run);
				$zone_code = $result['zone_code'];
				$emp_id = $result['emp_id'];
				$ref_no = $result['ref_no'];
				$ho_chalan = $result['ho_chalan'];
				$rec_status = $result['rec_status'];
				$entry_date = $result['entry_date'];
				$ho_date = $result['ho_date'];
				
			}else{
				echo "query problem";
			}


			if(isset($_POST['further_recive_submit'])){
		$category_id = mysqli_real_escape_string($db_con,$_POST['category_id']);
		$product_id = mysqli_real_escape_string($db_con,$_POST['product_id']);
		$lot = mysqli_real_escape_string($db_con,$_POST['lot']);
		$dem_quan = mysqli_real_escape_string($db_con,$_POST['dem_quan']);
		$quantity = mysqli_real_escape_string($db_con,$_POST['quantity']);
		$price = mysqli_real_escape_string($db_con,$_POST['price']);

		$entry_by =$_SESSION["user_name"];
		$rec_status = mysqli_real_escape_string($db_con,$_POST['rec_status']);


		if(empty($category_id)){
			array_push($error,'category name must be required');
		}else if(empty($product_id)){
			array_push($error,'product name must be required');
		}else if(empty($lot)){
			array_push($error,'unit price must be required');
		}else if(empty($dem_quan)){
			array_push($error,'demand quantity must be required');
		}else if(empty($quantity)){
			array_push($error,'quantity must be required');
		}else if(empty($rec_status)){
			array_push($error,'status must be required');
		}

		if(count($error)== 0){
			
			$sql = "INSERT INTO pro_recive_temporary (zone_code,category_id,product_id,emp_id,lot,dem_quan,quantity,price,ho_chalan,ref_no,ho_date,entry_date,entry_by,rec_status) VALUES ('$zone_code','$category_id','$product_id','$emp_id','$lot','$dem_quan','$quantity','$price','$ho_chalan','$ref_no','$ho_date','$entry_date','$entry_by','$rec_status')";
			if(mysqli_query($db_con,$sql)){ 

			}else{
				echo "query problem in insert query";
			}
		}
	}	


			if(isset($_POST['total_rcv_submit'])){
				$sql = "INSERT INTO pro_recive (`zone_code`, `category_id`, `product_id`, `emp_id`, `lot`, `dem_quan`, `quantity`, `price`, `ho_chalan`, `ref_no`, `ho_date`, `entry_date`, `entry_by`, `rec_status`) SELECT `zone_code`, `category_id`, `product_id`, `emp_id`, `lot`,`dem_quan`,`quantity`,`price`, `ho_chalan`, `ref_no`, `ho_date`, `entry_date`, `entry_by`, `rec_status` FROM pro_recive_temporary";
				if(mysqli_query($db_con,$sql)){
					echo "succesfull";
					$sql_truncate = "TRUNCATE table pro_recive_temporary";
					if(mysqli_query($db_con,$sql_truncate)){
						$_SESSION["last_rcv_id"] = " ";
						header('Location:product_recive_update.php');
					}else{
						echo "query problem in truncate query";
					}
				}else{
					echo "query problem at total submit";
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
				 <div class="container">
					   <h4 align="center">Enter Item Details</h4>
					   <br />
					   <?php include('error.php') ?>
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

						   				 ?>
						   				</option>
						   				</select>
						   			</td>
						   			<td>
						   				category:<select name="category_id" id="category" class="form-control category_id"><option value="">Select category</option>
						   					<?php echo load_category(); ?>
						   				</select>
						   			</td>
						   			<td>
						   				product:<select id="product" name="product_id" class="form-control product_id"><option value="">Select product</option></select>
						   			</td>
						   			<td>
						   				employee:<select name="emp_id" class="form-control emp_id"><option value="<?php echo $emp_id ?>">
						   					<?php
						   					$sql_employee = "SELECT emp_name from emp_table where emp_id='$emp_id'";
						   					$run_employee = mysqli_query($db_con,$sql_employee);
						   					$result_employee = mysqli_fetch_assoc($run_employee);
						   					$employee_name = $result_employee['emp_name'];
						   					echo $employee_name;

						   				 ?>
						   				</option>
						   				</select>
						   			</td>
					   			</tr>
					   			<tr>
						   			
						   			<td>
					   					demand:<input type="text" name="dem_quan" class="form-control dem_quan" />
					   				</td>
					   				<td>
						   				quantity:<input type="text" id="quantity" oninput="calculate()" name="quantity" class="form-control quantity" />
						   			</td>
						   			<td>
						   				unit price:<input type="text" name="lot" id="unit_price" oninput="calculate()" class="form-control unit_price" />
						   			</td>
						   			<td>
						   				total:<input type="text" id="total" value="calculate()" name="price" class="form-control price" />
						   			</td>
						   			

					   			</tr>
					   			<tr>
					   				<td>
						   				reference:<input type="text" value="<?php echo $ref_no ?>" name="ho_chalan" name="ref_no" class="form-control ref_no" />
						   			</td>
					   			<td>
					   				h/ochalan:<input type="text" value="<?php echo $ho_chalan ?>" name="ho_chalan" class="form-control hchalan" />
					   			</td>
					   			<td>
						   				h/o date:<input type="date" value="<?php echo $ho_date ?>" name="ho_date" class="form-control give_date" />
						   		</td>
						   		<td>
						   				insert date:<input type="date" value="<?php echo $entry_date ?>" name="entry_date" class="form-control give_date" />
						   		</td>
						   		</tr>
						   			
					   			<tr>
						   			<td>
						   				status:<select class="form-control rec_status" name="rec_status"><option >Select type</option><option value="1">Active</option><option value="2">Deactive</option></select>
						   			</td>
					   			</tr>
					   			<td>
					   				
					   			</td>
					   			<td>
					   				<button style="float: right" type="submit" id="submit_button_recive"  name="further_recive_submit" class="btn btn-danger btn-sm remove">add</button>
					   				
					   			</td>
					   			<td></td>
					   			<td>
					   				<a href="#" style="background: #5b81de;padding: 8px;color: white;float: left;" onclick="further_submit()"> add more</a>
					   			</td>
					   		</form>
					   </table>
				</div>	
					<!--/.fluid-container-->
				


			<div class="row-fluid sortable">		
					<div class="box span12">
						<div class="box-header" data-original-title>
							<h2><i class="halflings-icon user"></i><span class="break"></span>your total entry</h2>
							
						</div>
					
						<div class="box-content">
							<table class="table table-striped table-bordered ">
							  <thead>
								  <tr>
								  	  <th>Zone name</th>
									  <th>Category</th>
									  <th>Product</th>
									  <th>Employee</th>
									  <th>Unit price</th>
									  <th>Demand Quantity</th>
									  <th>Quantity</th>
									  <th>Total</th>
									  <th>H/O Chalan</th>
									  <th>Ref no</th>
									  <th>H/O Date</th>
									  <th>Entry date</th>
									  <th>Status</th>

								  </tr>
							  </thead>   
							  <tbody>
							  	<?php

									$sql = "SELECT * FROM pro_recive_temporary";
									$run = mysqli_query($db_con,$sql);
							  		 while($recive_info = mysqli_fetch_assoc($run)){
							  		
							  	 ?>
							  	 <form method="POST">
									<tr>
										<td class="center">
											<?php
												$zone_code = $recive_info['zone_code'];
												$zone = "SELECT zone_name from zone_info where zone_code = $zone_code";
												$zone_run = mysqli_query($db_con,$zone);
												$zone_result = mysqli_fetch_assoc($zone_run);
												$zone_name = $zone_result['zone_name'];

												echo $zone_name;

											 ?>
										 	
										 </td>
										<td class="center">
											<?php
												$category_id = $recive_info['category_id'];
												$category = "SELECT category_name from category where category_id = $category_id";
												$category_run = mysqli_query($db_con,$category);
												$category_result = mysqli_fetch_assoc($category_run);
												$category_name = $category_result['category_name'];

												echo $category_name;

											 ?>
										</td>
										<td class="center">
											<?php
												$product_id = $recive_info['product_id'];
												$product = "SELECT product_name from product where product_id = $product_id";
												$product_run = mysqli_query($db_con,$product);
												$product_result = mysqli_fetch_assoc($product_run);
												$product_name = $product_result['product_name'];

												echo $product_name;

											 ?>
										</td>
										<td class="center">
											<?php
												$emp_id = $recive_info['emp_id'];
												$emp = "SELECT emp_name from emp_table where emp_id = $emp_id";
												$emp_run = mysqli_query($db_con,$emp);
												$emp_result = mysqli_fetch_assoc($emp_run);
												$emp_name = $emp_result['emp_name'];

												echo $emp_name;

											 ?>
										</td>
										<td class="center"><?php echo $recive_info['lot']; ?></td>
										
										<td class="center"><?php echo $recive_info['dem_quan']; ?></td>
										<td class="center"><?php echo $recive_info['quantity']; ?></td>
										<td class="center"><?php echo $recive_info['price']; ?></td>
										<td class="center"><?php echo $recive_info['ho_chalan']; ?></td>
										<td class="center"><?php echo $recive_info['ref_no']; ?></td>
										<td class="center"><?php echo $recive_info['ho_date']; ?></td>
										<td class="center"><?php echo $recive_info['entry_date']; ?></td>
										<td class="center">
											<?php
												$rec_status = $recive_info['rec_status'];
												
												if($rec_status == 1){
													echo "active";
												}else{
													echo "deactive";
												}

											 ?>
										</td>
										
										
										<td class="center">
											<a class="btn btn-danger" href="edit_user.php?id=<?php echo $recive_info['temp_rcv_id'] ?>" title="view_product"> edit                                        
											</a>
										</td>
										
									</tr>
								<?php } ?>

									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>
											<button style="float: right" type="submit" name="total_rcv_submit" class="btn btn-primary btn-sm remove"> submit</button>
										</td>
									</tr>
								</form>
							  </tbody>
						  </table>            
						</div>
					</div><!--/span-->
				
				</div>
				</div>
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<?php include('footer.php'); ?>



 	<script>
 		function calculate() {
		var myBox1 = document.getElementById('unit_price').value;	
		var myBox2 = document.getElementById('quantity').value;
		var total = document.getElementById('total');	
		var myResult = myBox1 * myBox2;
		total.value = myResult;
		return myResult;
	}


	function further_submit(){
		 var retVal = confirm("you want more entry ?");
           if( retVal == true ) {
           	window.location="further_form.php";
           } else {
              document.write ("User does not want to continue!");
              return false;
           }
	}
 	</script>

	<script>
	$(document).ready(function(){
		$('#zone').change(function(){
			var zone_code= $(this).val();
			$.ajax({
				url:"fetchdependent_given.php",
				method:"POST",
				data:{zoneId:zone_code},
				dataType:"text",
				success:function(data){
					$('#brance').html(data);
				}

			});
		});

		$('#category').change(function(){
			var category_id= $(this).val();
			$.ajax({
				url:"fetchdependent_given_product.php",
				method:"POST",
				data:{categoryId:category_id},
				dataType:"text",
				success:function(data){
					$('#product').html(data);
				}

			});
		});
	});

</script>
