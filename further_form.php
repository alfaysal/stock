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

		


		


			$sql = "SELECT * FROM pro_given_temporary1 where temp_giv_id='".$_SESSION["last_id"]."'";
			if($run = mysqli_query($db_con,$sql)){
				$result = mysqli_fetch_assoc($run);
				$chalan = $result['chalan'];
				$zone_code = $result['zone_code'];
				$brance_code = $result['brance_code'];
				$emp_id = $result['emp_id'];
				$ref_no = $result['ref_no'];
				$advice = $result['advice'];
				
			}else{
				echo "query problem";
			}


			if(isset($_POST['further_submit_given'])){
		$category_id = mysqli_real_escape_string($db_con,$_POST['category_id']);
		$product_id = mysqli_real_escape_string($db_con,$_POST['product_id']);
		$lot = mysqli_real_escape_string($db_con,$_POST['lot']);
		$hchalan = mysqli_real_escape_string($db_con,$_POST['hchalan']);
		$dem_quan = mysqli_real_escape_string($db_con,$_POST['dem_quan']);
		$quantity = mysqli_real_escape_string($db_con,$_POST['quantity']);
		$price = mysqli_real_escape_string($db_con,$_POST['price']);
		$unit_price = mysqli_real_escape_string($db_con,$_POST['unit_price']);
		$give_date = mysqli_real_escape_string($db_con,$_POST['give_date']);

		$given_by =$_SESSION["user_name"];
		if(empty($category_id)){
			array_push($error,'category name must be required');
		}else if(empty($product_id)){
			array_push($error,'product name must be required');
		}else if(empty($lot)){
			array_push($error,'lot name must be required');
		}else if(empty($hchalan)){
			array_push($error,'head office chalan must be required');
		}else if(empty($dem_quan)){
			array_push($error,'demand quantity must be required');
		}else if(empty($quantity)){
			array_push($error,'quantity must be required');
		}else if(empty($price)){
			array_push($error,'price must be required');
		}else if(empty($unit_price)){
			array_push($error,'unit price must be required');
		}else if(empty($give_date)){
			array_push($error,'given date must be required');
		}

		if(count($error)== 0){
			
			$sql = "INSERT INTO pro_given_temporary1 (zone_code,brance_code,category_id,product_id,lot,emp_id,chalan,hchalan,ref_no,dem_quan,quantity,price,unit_price,give_date,given_by,advice) VALUES ('$zone_code','$brance_code','$category_id','$product_id','$lot','$emp_id','$chalan','$hchalan','$ref_no','$dem_quan','$quantity','$price','$unit_price','$give_date','$given_by','$advice')";
			if(mysqli_query($db_con,$sql)){ 

			}else{
				echo "query problem in insert query";
			}
		}
	}	


			if(isset($_POST['total_submit'])){
				$sql = "INSERT INTO pro_given (`zone_code`, `brance_code`, `category_id`, `product_id`, `lot`, `emp_id`, `chalan`, `hchalan`, `ref_no`, `dem_quan`, `quantity`, `price`, `unit_price`, `give_date`, `given_by`, `advice`) SELECT `zone_code`, `brance_code`, `category_id`, `product_id`, `lot`, `emp_id`, `chalan`, `hchalan`, `ref_no`, `dem_quan`, `quantity`, `price`, `unit_price`, `give_date`, `given_by`, `advice` FROM pro_given_temporary1";
				if(mysqli_query($db_con,$sql)){
					echo "succesfull";
					$sql_truncate = "TRUNCATE table pro_given_temporary1";
					if(mysqli_query($db_con,$sql_truncate)){
						$_SESSION["last_id"] = " ";
						header('Location:reportchalan.php');
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
					   <h4 align="center">Enter more item</h4>
					   <br />
					   <?php include('error.php'); ?>
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
						   			<td>
						   				h/o chalan:<select id="hchalan" name="hchalan"  class="form-control hchalan"><option value="">Select hchalan</option></select>
						   			</td>

					   			</tr>
					   			
					   			<td>
					   				demand:<input type="text" name="dem_quan" class="form-control dem_quan" />
					   			</td>
						   			<td>
						   				quantity:<input type="text" id="quantity" oninput="calculate()" name="quantity" class="form-control quantity" />
						   			</td>
						   			<td>
						   				unit <input type="text" name="unit_price" id="unit_price" oninput="calculate()" class="form-control unit_price" />
						   			</td>
						   			<td>
						   				total:<input type="text" id="total" value="calculate()" name="price" class="form-control price" />
						   			</td>
						   			
					   			<tr>
						   			
						   			<td>
						   				give date:<input type="date" name="give_date" class="form-control give_date" />
						   			</td>
						   			<td>
						   				advice:<input type="text" name="advice" class="form-control advice" value="<?php echo $advice ?>" />
						   			</td>
						   			<td>
						   				<input type="hidden" name="lot" value="10" class="form-control ref_no" />
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
									  <th>Brance Name</th>
									  <th>Category</th>
									  <th>Product</th>
									  <th>Employee</th>
									  <th>Reference no</th>
									  <th>Chalan</th>
									  <th>H/O chalan</th>
									  <th>Demand</th>
									  <th>Quantity</th>
									  <th>Unit</th>
									  <th>Total</th>
									  <th>Date</th>
									  <th>Advoice</th>

								  </tr>
							  </thead>   
							  <tbody>
							  	<?php

									$sql = "SELECT * FROM pro_given_temporary1";
									$run = mysqli_query($db_con,$sql);
							  		 while($given_info = mysqli_fetch_assoc($run)){
							  		
							  	 ?>
							  	 <form method="POST">
									<tr>
										<td class="center">
											<?php
												$zone_code = $given_info['zone_code'];
												$zone = "SELECT zone_name from zone_info where zone_code = $zone_code";
												$zone_run = mysqli_query($db_con,$zone);
												$zone_result = mysqli_fetch_assoc($zone_run);
												$zone_name = $zone_result['zone_name'];

												echo $zone_name;

											 ?>
										</td>
										<td class="center">
											<?php
												$brance_code = $given_info['brance_code'];
												$brance = "SELECT brance_name from brance_info where brance_code = $brance_code";
												$brance_run = mysqli_query($db_con,$brance);
												$brance_result = mysqli_fetch_assoc($brance_run);
												$brance_name = $brance_result['brance_name'];

												echo $brance_name;

											 ?>
										</td>
										<td class="center">
											<?php
												$category_id = $given_info['category_id'];
												$category = "SELECT category_name from category where category_id = $category_id";
												$category_run = mysqli_query($db_con,$category);
												$category_result = mysqli_fetch_assoc($category_run);
												$category_name = $category_result['category_name'];

												echo $category_name;

											 ?>
										</td>
										<td class="center">
											<?php
												$product_id = $given_info['product_id'];
												$product = "SELECT product_name from product where product_id = $product_id";
												$product_run = mysqli_query($db_con,$product);
												$product_result = mysqli_fetch_assoc($product_run);
												$product_name = $product_result['product_name'];

												echo $product_name;

											 ?>
										</td>
										<td class="center">
											<?php
												$emp_id = $given_info['emp_id'];
												$emp = "SELECT emp_name from emp_table where emp_id = $emp_id";
												$emp_run = mysqli_query($db_con,$emp);
												$emp_result = mysqli_fetch_assoc($emp_run);
												$emp_name = $emp_result['emp_name'];

												echo $emp_name;

											 ?>
										</td>
										<td class="center"><?php echo $given_info['ref_no']; ?></td>
										<td class="center"><?php echo $given_info['chalan']; ?></td>
										<td class="center"><?php echo $given_info['hchalan']; ?></td>
										<td class="center"><?php echo $given_info['dem_quan']; ?></td>
										<td class="center"><?php echo $given_info['quantity']; ?></td>
										<td class="center"><?php echo $given_info['unit_price']; ?></td>
										<td class="center"><?php echo $given_info['price']; ?></td>
										<td class="center"><?php echo $given_info['give_date']; ?></td>
										<td class="center"><?php echo $given_info['advice']; ?></td>
										
										
										<td class="center">
											<a class="btn btn-danger" href="edit_given.php?giv_id=<?php echo $given_info['temp_giv_id'] ?>" title="view_product"> edit                                         
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
											<button style="float: right" type="submit" name="total_submit" class="btn btn-primary btn-sm remove"> submit</button>
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


		$('#product').change(function(){
			var product_id= $(this).val();
			$.ajax({
				url:"fetchdependent_given_chalan.php",
				method:"POST",
				data:{productId:product_id},
				dataType:"text",
				success:function(data){
					$('#hchalan').html(data);
				}

			});
		});


	});

</script>
