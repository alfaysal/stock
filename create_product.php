<?php

	include('server.php');
	include('session_security.php');

	if(isset($_POST['submit_pro'])){
		$product_name = mysqli_real_escape_string($db_con,$_POST['product_name']);
		$product_description = mysqli_real_escape_string($db_con,$_POST['product_description']);
		$category_id = mysqli_real_escape_string($db_con,$_POST['category_id']);

		if(empty($product_name)){
			array_push($error,'product name must be required');
		}else if(empty($product_description)){
			array_push($error,'product description must be required');
		}else if(empty($category_id)){
			array_push($error,'category name must be required');
		}

		if(count($error)== 0){
			$sql = "INSERT INTO product (product_name,product_description,category_id) VALUES ('$product_name','$product_description','$category_id')";
			if(mysqli_query($db_con,$sql)){
				header('Location:create_product.php');
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
				<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Create Category</h2>
						<div class="box-icon">
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<?php include('error.php') ?>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="create_product.php">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Product Name </label>
							  <div class="controls">
								<input type="text" name="product_name">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Product description </label>
							  <div class="controls">
							  	<textarea rows="4" cols="50" name="product_description">
								</textarea>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Category Name</label>
							  <div class="controls">
							  		<?php


										$sql = "SELECT * FROM category";
										$result1 = mysqli_query($db_con,$sql);

										echo "<select name='category_id'>";
									?>
											<option>Select category</option>
									<?php
										while ($row = mysqli_fetch_array($result1)) {
												$category_id = $row['category_id'];
												$category_name = $row['category_name'];
										    echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
										}
										echo "</select>";

									?>
							  </div>
							</div>

							<button style="margin-left: 200px" type="submit" name="submit_pro" class="btn btn-primary">Save
							Product</button>
							
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