<?php

	include('server.php');
	include('session_security.php');
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
							<h2><i class="halflings-icon edit"></i><span class="break"></span>Create User</h2>
							<div class="box-icon">
								<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
							</div>
						</div>
						<?php include('error.php') ?>
						<div class="box-content">
							<form class="form-horizontal" method="post" action="server.php">
							  <fieldset>
								<div class="control-group">
								  <label class="control-label" for="typeahead">User Id </label>
								  <div class="controls">
									<input type="text" name="user_id">
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">User Name </label>
								  <div class="controls">
									<input type="text" name="user_name">
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Password </label>
								  <div class="controls">
									<input type="password" name="password">
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">User Status</label>
								  <div class="controls">
									  <select class="form-control" id="sel1" name="user_status">
									  	<option>Select type</option>
									    <option value="1">Active</option>
									    <option value="2">Deactive</option>
									  </select>
									</div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">User type</label>
								  <div class="controls">
									  <select class="form-control" id="sel1" name="type">
									  	<option>Select type</option>
									    <option value="1">Admin</option>
									    <option value="2">User</option>
									  </select>
									</div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">Zone Name</label>
								  <div class="controls">
								  		<?php

											$db_con = mysqli_connect('localhost', 'root', '','rps');

											$sql = "SELECT * FROM zone_info";
											$result1 = mysqli_query($db_con,$sql);

											echo "<select name='zone_code'>";
										?>
												<option>Select Zone</option>
										<?php
											while ($row = mysqli_fetch_array($result1)) {
													$zone_id = $row['zone_id'];
													$zone_code = $row['zone_code'];
													$zone_name = $row['zone_name'];
											    echo "<option value='" . $row['zone_code'] . "'>" . $row['zone_name'] . "</option>";
											}
											echo "</select>";

										?>
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">User Address</label>
								  <div class="controls">
									<input type="text" name="user_address">
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">User mobile</label>
								  <div class="controls">
									<input type="text" name="user_mobile">
								  </div>
								</div>
								<div class="control-group">
								  <label class="control-label" for="typeahead">User Designation</label>
								  <div class="controls">
									<input type="text" name="designation">
								  </div>
								</div>

								<button type="submit" name="submit" class="btn btn-primary">Save
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