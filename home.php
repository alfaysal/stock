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
							<table class="table table-striped table-bordered">
							  
							  	<?php
							  	$sql = "select * from category";
								$run = mysqli_query($db_con,$sql);
								while($result=mysqli_fetch_assoc($run)){
									?><thead>
										<tr>
							  				<td>Category</td>
									  	 	<td>Product</td>
									  	 	<td>Head office chalan</td>
									  	 	<td>Unit price</td>
									  	 	<td>Quantity</td>
									  	 	<td>Total</td>
							  			</tr>
									</thead>

									<?php
									$category = $result['category_id'];
									$sql2 = "select * from product where category_id='$category'";
									$run2 = mysqli_query($db_con,$sql2);
									while($result2 = mysqli_fetch_assoc($run2)){
										$product_id = $result2['product_id'];?>

										
							  			<?php
							  			
							  			$session_zone = $_SESSION["zone_code"];
										$sql3 = "SELECT  rcv.category_id, rcv.product_id, rcv.ho_chalan, rcv.lot, (COALESCE(rcv.Q1,0) - COALESCE(giv.Q2, 0))  as balance,(COALESCE(rcv.Q1,0) - COALESCE(giv.Q2, 0))*rcv.lot as amount
											   from
											    (select sum(quantity)as Q1,lot, ho_chalan,category_id, product_id from pro_recive where zone_code=$session_zone group by product_id,ho_chalan) AS rcv
											    left join
											    (select sum(quantity) as Q2,unit_price, hchalan,category_id, product_id from pro_given where zone_code=$session_zone group by product_id,hchalan) AS giv 
											    on (rcv.product_id = giv.product_id and rcv.ho_chalan = giv.hchalan) 
											    where rcv.product_id =$product_id 
											   having balance <> 0
											   order by 3 asc,2 asc 
											   ";
										 $run3 = mysqli_query($db_con,$sql3);

										 $sql4 ="SELECT stk.pro,stk.stok_lot, sum(stk.balance) as total_stock, sum(stk.amount) as total_amount from
												(SELECT rcv.ho_chalan, rcv.product_id as pro, rcv.category_id, rcv.lot stok_lot, rcv.Q1, giv.Q2, (COALESCE(rcv.Q1,0) - COALESCE(giv.Q2, 0))  as balance,(COALESCE(rcv.Q1,0) - COALESCE(giv.Q2, 0))*rcv.lot as amount
												   from
												    (select sum(quantity)as Q1,lot, ho_chalan,category_id, product_id from pro_recive where zone_code=$session_zone group by product_id,ho_chalan) AS rcv
												    left join
												    (select sum(quantity) as Q2,unit_price, hchalan,category_id, product_id from pro_given where zone_code=$session_zone group by product_id,hchalan) AS giv 
												    on (rcv.product_id = giv.product_id and rcv.ho_chalan = giv.hchalan) 
												   having balance <> 0
												   order by 3 asc,2 asc ) stk
												   where stk.pro=$product_id
												group by stk.pro
												  ";

											$run4 = mysqli_query($db_con,$sql4);
							  		while($result3=mysqli_fetch_assoc($run3)){	?>
							  			
							  			<tr>
								  		<td class="center"><?php echo $result['category_name']; ?></td>
										<td class="center"><?php echo $result2['product_name']; ?></td>
										<td class="center"><?php echo $result3['ho_chalan']; ?></td>
										<td class="center"><?php echo $result3['lot']; ?></td>
										<td class="center"><?php echo $result3['balance']; ?></td>
										<td class="center"><?php echo $result3['amount']; ?></td>
										
								  	</tr>
								  	<?php
								  }
							  			while($result4 = mysqli_fetch_assoc($run4)){

							  	 ?>
							  	 <tr>
							  	 	<td></td>
							  	 	<td></td>
							  	 	<td></td>
							  	 	<td>total</td>
							  	 	<td class="center"><?php echo $result4['total_stock']; ?></td>
							  	 	<td class="center"><?php echo $result4['total_amount']; ?></td>
							  	 	
							  	 </tr>
							  	<tr>
							  		<td></td>
							  	</tr>

							  	<tr>
							  		<td></td>
							  	</tr>
								  	 
								  	
								
							<?php
									
								}
							} 
						}
							?>
							  </tbody>
						  </table>            
						</div>
					</div><!--/span-->
				
				</div>
					

			</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<?php include('footer.php')
	; ?>