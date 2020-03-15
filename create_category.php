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
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Create Category</h2>
						<div class="box-icon">
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<?php include('error.php') ?>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="server.php">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Category Name </label>
							  <div class="controls">
								<input type="text" name="category_name">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Category description </label>
							  <div class="controls">
							  	<textarea rows="4" cols="50" name="category_description">
								</textarea>
							  </div>
							</div>
							

							<button type="submit" name="submit_cat" class="btn btn-primary">Save
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