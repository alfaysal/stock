<?php

	include('server.php');
	include('session_security.php');

		$connect = new PDO("mysql:host=localhost;dbname=rps", "root", "");
		function fill_unit_select_box($connect)
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
					       <th>Enter product Name</th>
					       <th>product description</th>
					       <th>Select category</th>
					       <th><button type="button" name="add" class="btn btn-success btn-sm add">add</button></th>
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
			  html += '<tr>';
			  html += '<td><input type="text" name="product_name[]" class="form-control product_name" /></td>';
			  html += '<td><input type="text" name="product_description[]" class="form-control product_description" /></td>';
			  html += '<td><select name="category_id[]" class="form-control category_id"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
			  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove">remove</button></td></tr>';
			  $('#item_table').append(html);
			 });
			 
			 $(document).on('click', '.remove', function(){
			  $(this).closest('tr').remove();
			 });
			 
			 $('#insert_form').on('submit', function(event){
			  event.preventDefault();
			  var error = '';
			  $('.product_name').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter product Name at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });
			  
			  $('.product_description').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Enter product description at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });
			  
			  $('.category_id').each(function(){
			   var count = 1;
			   if($(this).val() == '')
			   {
			    error += "<p>Select category at "+count+" Row</p>";
			    return false;
			   }
			   count = count + 1;
			  });
			  var form_data = $(this).serialize();
			  if(error == '')
			  {
			   $.ajax({
			    url:"insert.php",
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