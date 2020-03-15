<?php

	include('server.php');
	include('session_security.php');

	if(isset($_POST['submit_br'])){
		$brance_code = mysqli_real_escape_string($db_con,$_POST['brance_code']);
		$brance_name = mysqli_real_escape_string($db_con,$_POST['brance_name']);
		$zone_code = mysqli_real_escape_string($db_con,$_POST['zone_code']);

		if(empty($brance_code)){
			array_push($error,'brance code must be required');
		}
		else if(empty($brance_name)){
			array_push($error,'brance name must be required');
		}
		else if(empty($zone_code)){
			array_push($error,'zone code must be required');
		}

		if(count($error)== 0){
			$sql = "INSERT INTO brance_info (brance_code,brance_name,zone_code) VALUES ('$brance_code','$brance_name','$zone_code')";
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
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Create Brance</h2>
						<div class="box-icon">
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<?php include('error.php') ?>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="create_brance.php">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Brance code </label>
							  <div class="controls">
								<input type="text" name="brance_code">
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="typeahead">Brance name </label>
							  <div class="controls">
								<input type="text" name="brance_name">
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

							<button type="submit" name="submit_br" class="btn btn-primary">Save
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