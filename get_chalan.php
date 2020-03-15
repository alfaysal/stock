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

				<div class="container" >
					   
					 <h2>Search Chalan Number To Get Your Chalan</h2>
						<form class="get_chalan" action="" method="post">
						  <input type="text" placeholder="Search.." name="search_chalan">
						  <button type="submit" name="chalan_submit"><i class="fa fa-search"></i></button>
						</form>

				 </div>	
				 <div class="box-content">
							<table class="table table-striped table-bordered">
							  <thead>
								  <tr>
									  <th>chalan</th>
									  
								  </tr>
							  </thead>   
							  <tbody>
							  	<?php
										if(isset($_POST["chalan_submit"])){
											$search_chalan = mysqli_real_escape_string($db_con,$_POST["search_chalan"]);

											$sql = "SELECT distinct(chalan) FROM pro_given WHERE chalan = $search_chalan";
											if($run = mysqli_query($db_con,$sql)){
											
											if(mysqli_num_rows($run)>0){
												while($result = mysqli_fetch_assoc($run)){
							  	 ?>
								<tr>
									<td class="center"><a href="search_chalan.php?chalan=<?php  echo $result['chalan'] ?>"><?php echo $result['chalan']; ?></a></td>
									
								</tr>

								<?php 

											}
							
									} else{
										echo '<script language="javascript">';
										echo 'alert("chalan number invalid")';
										echo '</script>';
									}
								}
							}


							?>
							  </tbody>
						  </table>            
						</div>

				
				

			</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<?php include('footer.php'); ?>