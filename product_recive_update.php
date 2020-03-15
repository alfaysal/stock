<?php

	include('server.php');
	include('session_security.php');


	function load_zone(){
		$connect = mysqli_connect('localhost','root','','rps');
		$output = '';
		$sql = "SELECT * from zone_info order by zone_name";
		$result  = mysqli_query($connect,$sql);
		while($row=mysqli_fetch_array($result)){
			$output .= '<option value="'.$row["zone_code"].'">'.$row["zone_name"].'</option>';
		}
		return $output;
	}

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


		function fill_unit_select_box_emp()
		{ 
		$connect = mysqli_connect('localhost','root','','rps');
		 $output = '';
		 $query = "SELECT * FROM emp_table ORDER BY emp_name ASC";
		 $result  = mysqli_query($connect,$query);
			while($row=mysqli_fetch_array($result)){
			$output .= '<option value="'.$row["emp_id"].'">'.$row["emp_name"].'</option>';
		}
		return $output;
		}


	if(isset($_POST['add_to_temp_rcv'])){
		$zone_code = mysqli_real_escape_string($db_con,$_POST['zone_code']);
		$category_id = mysqli_real_escape_string($db_con,$_POST['category_id']);
		$product_id = mysqli_real_escape_string($db_con,$_POST['product_id']);
		$lot = mysqli_real_escape_string($db_con,$_POST['lot']);
		$emp_id = mysqli_real_escape_string($db_con,$_POST['emp_id']);
		$ref_no = mysqli_real_escape_string($db_con,$_POST['ref_no']);
		$ho_chalan = mysqli_real_escape_string($db_con,$_POST['ho_chalan']);
		$dem_quan = mysqli_real_escape_string($db_con,$_POST['dem_quan']);
		$quantity = mysqli_real_escape_string($db_con,$_POST['quantity']);
		$price = mysqli_real_escape_string($db_con,$_POST['price']);
		$ho_date = mysqli_real_escape_string($db_con,$_POST['ho_date']);
		$entry_date = mysqli_real_escape_string($db_con,$_POST['entry_date']);

		$entry_by =$_SESSION["user_name"];
		$rec_status = mysqli_real_escape_string($db_con,$_POST['rec_status']);


		if(empty($zone_code)){
			array_push($error,'zone code must be required');
		}else if(empty($category_id)){
			array_push($error,'category name must be required');
		}else if(empty($product_id)){
			array_push($error,'product name must be required');
		}else if(empty($lot)){
			array_push($error,'unit price must be required');
		}else if(empty($emp_id)){
			array_push($error,'employee name must be required');
		}else if(empty($ref_no)){
			array_push($error,'reference no must be required');
		}else if(empty($ho_chalan)){
			array_push($error,'head office chalan must be required');
		}else if(empty($dem_quan)){
			array_push($error,'demand quantity must be required');
		}else if(empty($entry_date)){
			array_push($error,'entry date must be required');
		}else if(empty($ho_date)){
			array_push($error,'inser date must be required');
		}else if(empty($rec_status)){
			array_push($error,'status must be required');
		}

		if(count($error)== 0){
			$_SESSION["last_rcv_id"]= " ";
			$sql = "INSERT INTO pro_recive_temporary (zone_code,category_id,product_id,emp_id,lot,dem_quan,quantity,price,ho_chalan,ref_no,ho_date,entry_date,entry_by,rec_status) VALUES ('$zone_code','$category_id','$product_id','$emp_id','$lot','$dem_quan','$quantity','$price','$ho_chalan','$ref_no','$ho_date','$entry_date','$entry_by','$rec_status')";
			if(mysqli_query($db_con,$sql)){
				$last_rcv_id = mysqli_insert_id($db_con);
				$_SESSION["last_rcv_id"] = $last_rcv_id;
				header('Location:further_recive_form.php');
			}else{
				echo "query problem";
			}
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
						   				ZONE:<select name="zone_code" id="zone" class="form-control zone_code"><option value="">Select zone</option>
						   					<?php echo load_zone(); ?>
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
						   				employee:<select name="emp_id" class="form-control emp_id"><option value="">Select employee</option>
						   					<?php echo fill_unit_select_box_emp() ; ?>
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
						   				reference:<input type="text" name="ref_no" class="form-control ref_no" />
						   			</td>
					   			<td>
					   				h/ochalan:<input type="text" name="ho_chalan" class="form-control hchalan" />
					   			</td>
					   			<td>
						   				h/o date:<input type="date" name="ho_date" class="form-control give_date" />
						   		</td>
						   		<td>
						   				insert:<input type="date" name="entry_date" class="form-control give_date" />
						   		</td>
						   		</tr>
						   			
					   			<tr>
						   			<td>
						   				status:<select class="form-control rec_status" name="rec_status"><option>Select type</option><option value="1">Active</option><option value="2">Deactive</option></select>
						   			</td>
					   			</tr>
					   			<td>
					   				
					   			</td>
					   			<td>
					   				<button style="float: right" type="submit" id="submit_button_recive"  name="add_to_temp_rcv" class="btn btn-danger btn-sm remove">add</button>
					   				
					   			</td>
					   			<td></td>
					   			<td>
					   				<a href="#" style="background: #5b81de;padding: 8px;color: white;float: left;" onclick="further_submit()"> add more</a>
					   			</td>
					   		</form>
					   </table>
				</div>	


				
					<!--/.fluid-container-->
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
           	window.location="product_given_update.php";
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
