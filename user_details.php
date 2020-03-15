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
							<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
							<div class="box-icon">
								<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
								<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
								<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
							</div>
						</div>
					
						<div class="box-content">
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
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

									$sql = "SELECT * FROM user_table2";
									$run = mysqli_query($db_con,$sql);
							  		 while($user_info = mysqli_fetch_assoc($run)){
							  		
							  	 ?>
								<tr>
									<td class="center"><?php echo $user_info['user_id']; ?></td>
									<td class="center"><?php echo $user_info['user_name']; ?></td>
									<td class="center"><?php echo $user_info['user_status']; ?></td>
									<td class="center"><?php echo $user_info['type']; ?></td>
									<td class="center"><?php echo $user_info['zone_code']; ?></td>
									<td class="center"><?php echo $user_info['user_address']; ?></td>
									<td class="center"><?php echo $user_info['user_mobile']; ?></td>
									<td class="center"><?php echo $user_info['designation']; ?></td>
									<td class="center"><?php echo $user_info['created_by']; ?></td>
									
									
									<td class="center">
										<a class="btn btn-success" href="edit_user.php?id=<?php echo $user_info['user_id'] ?>" title="view_product"> update                                         
										</a>
									</td>
									
								</tr>
							<?php } ?>
							  </tbody>
						  </table>            
						</div>
					</div><!--/span-->
				
				</div>
					

			</div><!--/.fluid-container-->
		
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<?php include('footer.php'); ?>