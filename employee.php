<?php

	include('server.php');
	include('session_security.php');

	if(isset($_POST['submit_emp'])){
		$emp_reg_num = mysqli_real_escape_string($db_con,$_POST['emp_reg_num']);
		$emp_name = mysqli_real_escape_string($db_con,$_POST['emp_name']);
		$emp_designation = mysqli_real_escape_string($db_con,$_POST['emp_designation']);
		$contact = mysqli_real_escape_string($db_con,$_POST['contact']);
		$brance_code = mysqli_real_escape_string($db_con,$_POST['brance_code']);
		$zone_code = mysqli_real_escape_string($db_con,$_POST['zone_code']);

		if(empty($emp_reg_num)){
			array_push($error,'employee registration must be required');
		}
		else if(empty($emp_name)){
			array_push($error,'employe name must be required');
		}
		else if(empty($emp_designation)){
			array_push($error,'designation must be required');
		}
		else if(empty($contact)){
			array_push($error,'contact must be required');
		}
		else if(empty($brance_code)){
			array_push($error,'brance must be required');
		}
		else if(empty($zone_code)){
			array_push($error,'zone must be required');
		}


		if(count($error)== 0){
			$sql = "INSERT INTO emp_table (emp_reg_num,emp_name,emp_designation,contact,brance_code,zone_code) VALUES ('$emp_reg_num','$emp_name','$emp_designation','$contact','$brance_code','$zone_code')";
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
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Create Employee</h2>
						<div class="box-icon">
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<?php include('error.php') ?>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="employee.php">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Registration number </label>
							  <div class="controls">
								<input type="number" name="emp_reg_num">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="typeahead">Employee Name </label>
							  <div class="controls">
								<input type="text" name="emp_name">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="typeahead">Employee designation </label>
							  <div class="controls">
								<input type="text" name="emp_designation">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="typeahead">Contact number </label>
							  <div class="controls">
								<input type="text" name="contact">
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

							<button type="submit" name="submit_emp" class="btn btn-primary">Save
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