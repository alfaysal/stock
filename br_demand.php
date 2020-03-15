<?php

	include('server.php');
	include('session_security.php');

	if(isset($_POST['submit_dem'])){
		$zone_code = mysqli_real_escape_string($db_con,$_POST['zone_code']);
		$brance_code = mysqli_real_escape_string($db_con,$_POST['brance_code']);
		$category_id = mysqli_real_escape_string($db_con,$_POST['category_id']);
		$product_id = mysqli_real_escape_string($db_con,$_POST['product_id']);
		$pro_quan = mysqli_real_escape_string($db_con,$_POST['pro_quan']);
		$demand_status = mysqli_real_escape_string($db_con,$_POST['demand_status']);

		if(empty($zone_code)){
			array_push($error,'zone code must be required');
		}
		else if(empty($brance_code)){
			array_push($error,'brance name must be required');
		}
		else if(empty($category_id)){
			array_push($error,'category must be required');
		}
		else if(empty($product_id)){
			array_push($error,'product must be required');
		}
		else if(empty($pro_quan)){
			array_push($error,'Quantity must be required');
		}
		else if(empty($demand_status)){
			array_push($error,'status must be required');
		}

		if(count($error)== 0){
			$sql = "INSERT INTO demand (zone_code,brance_code,category_id,product_id,pro_quan,demand_status) VALUES ('$zone_code','$brance_code','$category_id','$product_id','$pro_quan','$demand_status')";
			if(mysqli_query($db_con,$sql)){
				header('Location:home.php');
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
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Brance demand</h2>
						<div class="box-icon">
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<?php include('error.php') ?>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="br_demand.php">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Zone Name</label>
							  <div class="controls">
							  		<?php


										$sql = "SELECT * FROM zone_info";
										$result1 = mysqli_query($db_con,$sql);

										echo "<select name='zone_code'>";
									?>
											<option>Select zone</option>
									<?php
										while ($row = mysqli_fetch_array($result1)) {
												$zone_code = $row['zone_code'];
												$zone_name = $row['zone_name'];
										    echo "<option value='" . $row['zone_code'] . "'>" . $row['zone_name'] . "</option>";
										}
										echo "</select>";

									?>
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="typeahead">Brance Name</label>
							  <div class="controls">
							  		<?php


										$sql = "SELECT * FROM brance_info ";
										$result1 = mysqli_query($db_con,$sql);

										echo "<select name='brance_code'>";
									?>
											<option>Select brance</option>
									<?php
										while ($row = mysqli_fetch_array($result1)) {
												$brance_code = $row['brance_code'];
												$brance_name = $row['brance_name'];
										    echo "<option value='" . $row['brance_code'] . "'>" . $row['brance_name'] . "</option>";
										}
										echo "</select>";

									?>
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

						
							<div class="control-group">
							  <label class="control-label" for="typeahead">Category Name</label>
							  <div class="controls">
							  		<?php


										$sql = "SELECT * FROM product";
										$result1 = mysqli_query($db_con,$sql);

										echo "<select name='product_id'>";
									?>
											<option>Select category</option>
									<?php
										while ($row = mysqli_fetch_array($result1)) {
												$product_id = $row['product_id'];
												$product_name = $row['product_name'];
										    echo "<option value='" . $row['product_id'] . "'>" . $row['product_name'] . "</option>";
										}
										echo "</select>";

									?>
							  </div>
							</div>


							<div class="control-group">
							  <label class="control-label" for="typeahead">Product Quantity </label>
							  <div class="controls">
								<input type="text" name="pro_quan">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="typeahead">User Status</label>
							  <div class="controls">
								  <select class="form-control" id="sel1" name="demand_status">
								  	<option>Select type</option>
								    <option value="1">Active</option>
								    <option value="2">Deactive</option>
								  </select>
								</div>
							</div>


							<button type="submit" name="submit_dem" class="btn btn-primary">Save
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