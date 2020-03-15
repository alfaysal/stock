<?php

	include('server.php');
	include('session_security.php');

		$connect = new PDO("mysql:host=localhost;dbname=rps", "root", "");
		function fill_unit_select_box($connect)
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

		function fill_unit_select_box3($connect)
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


		function fill_unit_select_box_emp($connect)
		{ 
		 $output = '';
		 $query = "SELECT * FROM emp_table ORDER BY emp_name ASC";
		 $statement = $connect->prepare($query);
		 $statement->execute();
		 $result = $statement->fetchAll();
		 foreach($result as $row)
		 {
		  $output .= '<option value="'.$row["emp_id"].'">'.$row["emp_name"].'</option>';
		 }
		 return $output;
		}


		function fill_unit_select_box2($connect)
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
					       <button type="button" name="add" class="btn btn-success btn-sm add">add</button>
					      </tr>
					     </table>
					     <div align="center">
					      <input type="submit" name="submit" class="btn btn-info" value="Insert" />
					     </div>
					    </div>
					   </form>
					  </div>				

			</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<?php include('footer.php'); ?>

	<script>
		$(document).ready(function(){
 
			 $(document).on('click', '.add', function(){
			  var html = '';
			  html += '<div>';
			  html += '<td>ZONE:<select name="zone_code[]" class="form-control zone_code"><option value="">Select zone</option><?php echo fill_unit_select_box($connect); ?></select></td>';
			   html += '<td>category:<select name="category_id[]" class="form-control category_id"><option value="">Select category</option><?php echo fill_unit_select_box3($connect); ?></select></td>';
			  html += '<td>product:<select name="product_id[]" class="form-control product_id"><option value="">Select product</option><?php echo fill_unit_select_box2($connect); ?></select></td>';
			  html += '<td>employee:<select name="emp_id[]" class="form-control emp_id"><option value="">Select employee</option><?php echo fill_unit_select_box_emp($connect); ?></select></td><br>';
			  html += '<td>lot:<input type="text" name="lot[]" class="form-control lot" /></td>';
			  html += '<td>demand quantity:<input type="text" name="dem_quan[]" class="form-control dem_quan" /></td>';
			  html += '<td>quantity:<input type="text" name="quantity[]" class="form-control quantity" /></td>';
			  html += '<td>price:<input type="text" name="price[]" class="form-control price" /></td><br>';
			  html += '<td>h.o chalan:<input type="text" name="ho_chalan[]" class="form-control ho_chalan" /></td>';
			  html += '<td>ref no:<input type="text" name="ref_no[]" class="form-control ref_no" /></td>';
			  html += '<td>h.o date:<input type="date" name="ho_date[]" class="form-control ho_date" /></td>';
			  html += '<td>insert date:<input type="date" name="entry_date[]" class="form-control entry_date" /></td><br>';
			  html += '<td>status:<select class="form-control rec_status" name="rec_status[]"><option>Select type</option><option value="1">Active</option><option value="2">Deactive</option></select></td>';
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

			   $('.category_id').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter category Name at "+count+" Row</p>";
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

			   $('.emp_id').each(function(){
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

			   $('.dem_quan').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Select demand quantity at "+count+" Row</p>";
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

			    $('.ho_chalan').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter ho chalan e at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });


			  $('.ho_num').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter head office number at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });

			   $('.ref_no').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter head office reference number at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });

			  $('.ho_date').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter head office date at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });

			  $('.insert_date').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter head office date at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });

			  $('.rec_status').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter status at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });


			  var form_data = $(this).serialize();
			  if(error == '')
			  {
			   $.ajax({
			    url:"insert_recive.php",
			    method:"POST",
			    data:form_data,
			    success:function(data)
			    {
			     if(data == 'ok')
			     {
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