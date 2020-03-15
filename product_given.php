l<?php

	include('server.php');
	include('session_security.php');



		$connect = new PDO("mysql:host=localhost;dbname=rps", "root", "");
		function fill_unit_select_box_zo($connect)
		{ 
		 $output = '';
		 $query = "SELECT * FROM zone_info ORDER BY zone_name ASC";
		 $statement = $connect->prepare($query);
		 $statement->execute();
		 $result = $statement->fetchAll();
		 foreach($result as $row)
		 {
		  $output .= '<option value="'.$row["zone_code"].'">'.$row["zone_name"].'</option>';
		 }
		 return $output;
		}

		function fill_unit_select_box_br($connect)
		{ 
		 $output = '';
		 $query = "SELECT * FROM brance_info ORDER BY brance_name ASC";
		 $statement = $connect->prepare($query);
		 $statement->execute();
		 $result = $statement->fetchAll();
		 foreach($result as $row)
		 {
		  $output .= '<option value="'.$row["brance_code"].'">'.$row["brance_name"].'</option>';
		 }
		 return $output;
		}

		function fill_unit_select_box_cat($connect)
		{ 
		 $output = '';
		 $query = "SELECT * FROM category ORDER BY category_name ASC";
		 $statement = $connect->prepare($query);
		 $statement->execute();
		 $result = $statement->fetchAll();
		 foreach($result as $row)
		 {
		  $output .= '<option value="'.$row["category_id"].'">'.$row["category_name"].'</option>';
		 }
		 return $output;
		}


		function fill_product(){

		}


		function fill_unit_select_box_pro($connect)
		{ 
		 $output = '';
		 $query = "SELECT * FROM product ORDER BY product_name ASC";
		 $statement = $connect->prepare($query);
		 $statement->execute();
		 $result = $statement->fetchAll();
		 foreach($result as $row)
		 {
		  $output .= '<option value="'.$row["product_id"].'">'.$row["product_name"].'</option>';
		 }
		 return $output;
		}

			function fill_unit_select_box_lot($connect)
		{ 
		 $output = '';
		 $query = "SELECT lot FROM pro_recive WHERE quantity>0";
		 $statement = $connect->prepare($query);
		 $statement->execute();
		 $result = $statement->fetchAll();
		 foreach($result as $row)
		 {
		  $output .= '<option value="'.$row["lot"].'">'.$row["lot"].'</option>';
		 }
		 return $output;
		}

		function fill_unit_select_box_emp($connect)
		{ 
		 $output = '';
		 $query = "SELECT * FROM employee ORDER BY employee_name ASC";
		 $statement = $connect->prepare($query);
		 $statement->execute();
		 $result = $statement->fetchAll();
		 foreach($result as $row)
		 {
		  $output .= '<option value="'.$row["employee_id"].'">'.$row["employee_name"].'</option>';
		 }
		 return $output;
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
					   <form method="post" id="insert_form">
					    <div class="table-repsonsive">
					     <span id="error"></span>
					     <table class="table table-bordered" id="item_table">
					      <tr>
					       <button type="button" name="give" class="btn btn-success btn-sm give">Give</button>
					      </tr>
					     </table>
					     <div align="center">
					      <input type="submit" name="submit" class="btn btn-info" value="Insert" />
					     </div>
					    </div>
					   </form>
					  </div>	
					<div class="row-fluid sortable">		
					<div class="box span12">
						<div class="box-header" data-original-title>
							<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
							<div class="box-icon">
								<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
								<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
								<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
							</div>
						</div>
					
						<div class="box-content">
							<table class="table table-striped table-bordered">
							  <thead>
								  <tr>
								  	  <th>User id</th>
									  <th>User Name</th>
									  <th>User status</th>
									  <th>User type</th>
									  <th>Zone code</th>
									  <th>User address</th>
									  <th>User number</th>
									  <th>User designation</th>
									  <th>Created by</th>

								  </tr>
							  </thead>   
							  <tbody>
							  	<?php

									$sql = "SELECT max(pro_giv_id), chalan, brance_code, give_date, category_id, product_id, lot,quantity,(lot*price) as total FROM pro_given";
									$run = mysqli_query($db_con,$sql);
							  		 while($user_info = mysqli_fetch_assoc($run)){
							  		
							  	 ?>
								<tr>
									<td class="center"><?php echo $user_info['chalan']; ?></td>
									<td class="center"><?php echo $user_info['brance_code']; ?></td>
									<td class="center"><?php echo $user_info['give_date']; ?></td>
									<td class="center"><?php echo $user_info['category_id']; ?></td>
									<td class="center"><?php echo $user_info['product_id']; ?></td>
									<td class="center"><?php echo $user_info['lot']; ?></td>
									<td class="center"><?php echo $user_info['quantity']; ?></td>
									<td class="center"><?php echo $user_info['total']; ?></td>
									
									
								</tr>
							<?php } ?>
							  </tbody>
						  </table>            
						</div>
					</div>
					  

			</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<?php include('footer.php'); ?>

	<script>
		$(document).ready(function(){
 
			 $(document).on('click', '.give', function(){
			  var html = '';
			  html += '<div>';
			  html += '<td>ZONE:<select name="zone_code[]" class="form-control zone_code"><option value="">Select zone</option><?php echo fill_unit_select_box_zo($connect); ?></select></td>';

			  html += '<td>brance:<select name="brance_code[]" class="form-control brance_code"><option value="">Select brance</option><?php echo fill_unit_select_box_br($connect); ?></select></td>';
			  html += '<td>category:<select name="category_id[]" class="form-control category_id"><option value="">Select category</option><?php echo fill_unit_select_box_cat($connect); ?></select></td>';
			  html += '<td>product:<select id="product" name="product_id[]" class="form-control product_id"><option value="">Select product</option><?php echo fill_unit_select_box_pro($connect); ?></select></td><br>';
			  html += '<td>lot:<select name="lot[]" class="form-control lot"><option value="">Select lot</option><?php echo fill_unit_select_box_lot($connect); ?></select></td>';
			  html += '<td>employee:<select name="employee_id[]" class="form-control employee_id"><option value="">Select employee</option><?php echo fill_unit_select_box_emp($connect); ?></select></td>';
			  html += '<td>reference no:<input type="text" name="ref_no[]" class="form-control ref_no" /></td>';
			  html += '<td>chalan:<input type="text" name="chalan[]" class="form-control chalan" /></td><br>';
			  html += '<td>h/ochalan:<input type="text" name="hchalan[]" class="form-control hchalan" /></td>';
			  html += '<td>demand:<input type="text" name="dem_quan[]" class="form-control dem_quan" /></td>';
			 html += '<td>quantity:<input type="text" name="quantity[]" class="form-control quantity" /></td>';
			  html += '<td>price:<input type="text" name="price[]" class="form-control price" /></td><br>';
			  html += '<td>unit-price:<input type="text" name="unit_price[]" class="form-control unit_price" /></td>';
			  html += '<td>give date:<input type="date" name="give_date[]" class="form-control give_date" /></td>';
			  html += '<td>advice:<input type="text" name="advice[]" class="form-control advice" /></td>';
			  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove">remove</button></td></div>';
			  $('#item_table').append(html);
			 });
			 
			 $(document).on('click', '.remove', function(){
			  $(this).closest('div').remove();
			 });
			 
			 $('#insert_form').on('submit', function(event){
			  event.preventDefault();

			  var error = '';
			  $('.zone_code').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter zone code at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });

			  $('.brance_code').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter brance code at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });

			        $('.category_id').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter category at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });

			 $('.product_id').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter product Name at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });
			  
			  $('.lot').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter lot at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });

			   $('.employee_id').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter employee at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });

			    $('.ref_no').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter reference at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });

			    $('.chalan').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter chalan at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });
			  
			  $('.quantity').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Select quantity at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });

			  $('.price').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter price Name at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });


			  $('.give_date').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter given date at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });
	
			 
			  var form_data = $(this).serialize();
			  if(error == '')
			  {
			   $.ajax({
			    url:"insert_given.php",
			    method:"POST",
			    data:form_data,
			    success:function(data)
			    {
			     if(data == 'ok')
			     {
			     	window.location = "reportchalan.php";
			      $('#item_table').find("tr:gt(0)").remove();
			      $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
			     }
			    }
			   });
			  }
			  else
			  {
			   $('#error').html('<div class="alert alert-danger">'+error+'</div>');
			  }
			 });
			 
			});
	</script>