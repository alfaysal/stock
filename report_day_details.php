<?php

	include('server.php');
	include('session_security.php');
	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION["user_id"]);
		unset($_SESSION["user_name"]);
		unset($_SESSION["type"]);
		header('Location:adminlogin.php');
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
				<div class="box-content">
							<table class="table table-striped table-bordered ">
							  <thead>
								  <tr>
								  	  <th>brance code</th>
									  <th>given date</th>
									  <th>category id</th>
									  <th>product id</th>
									  <th>unit price</th>
									  <th>chalan</th>
									  <th>quantity</th>
								  </tr>
							  </thead>   
							  <tbody>
							  	<?php
							  		if(isset($_POST['submit_rep'])){
										$from=mysqli_real_escape_string($db_con,$_POST['from']);
										$to=mysqli_real_escape_string($db_con,$_POST['to']);
										$brance_code=mysqli_real_escape_string($db_con,$_POST['brance_code']);
										echo $from,$to,$brance_code;

										$result=mysqli_query($db_con,"SELECT pg.brance_code,pg.give_date,c.category_name,p.product_name,pg.unit_price,pg.chalan,pg.quantity
											from pro_given pg 
											inner join category c
											on c.category_id=pg.category_id
											inner join product p
											on p.product_id=pg.product_id
											where pg.brance_code='$brance_code' and pg.give_date between '$from' and '$to' 
											order by pg.give_date asc");
									


							  		 while($report_day = mysqli_fetch_array($result))
							  		 		
							  		 {
							  		
							  	 ?>
								<tr>
									<td class="center"><?php echo $report_day['brance_code']; ?></td>
									<td class="center"><?php echo $report_day['give_date']; ?></td>
									<td class="center"><?php echo $report_day['category_name']; ?></td>
									<td class="center"><?php echo $report_day['product_name']; ?></td>
									<td class="center"><?php echo $report_day['unit_price']; ?></td>
									<td class="center"><?php echo $report_day['chalan']; ?></td>
									<td class="center"><?php echo $report_day['quantity']; ?></td>
									
								</tr>
							<?php } }?>
							  </tbody>
						  </table>            
						</div>	





			</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<?php include('footer.php')
	; ?>