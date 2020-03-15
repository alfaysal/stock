
<?php include('server.php'); ?>
<!DOCTYPE html PUBLIC "" "">
<html xmlns="">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!-- In HTML5 -->
<meta charset="utf-8">

<style>
      @font-face { font-family: kalpurush; src: url('fonts/kalpurush.ttf'); } 
      body {
         font-family: kalpurush;font-size: 14
      }
	  .chalan {
        height: 842px;
        width: 595px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
    }
	
	.chalan_header {
	margin: 0px;
    padding: .5px;
	}
	
	.chalan_header1 {
	margin: 0px;
    padding: 0px;
	}
	
	.left_up {
		float: left;
		width: 200px;
		height: 75px;
		padding: 0px;
		margin: 0px;
		 
	}
	
	.right_up {
		float: right;
		width: 250px;
		height: 75px;
		padding: 0px;
		margin: 0px;
		 
	}
	
	.right_down1 {
		float: right;
		width: 150px;
		height: 75px;
		padding: 0px;
		margin-top: 40px;
		
		 
	}
	
	.right_down2 {
		float: left;
		width: 600px;
		height: 75px;
		padding: 0px;
		margin-top: 0px;
		
		 
	}
	.right_down2 p {
		
		float: right;
		 
	}
	table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
}

hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
} 
    </style>
</head>
<body>


    <?php include('navbar.php'); ?>
  <?php

  	if(isset($_GET['chalan'])){
  		$chalan = $_GET['chalan'];
  	}	
  		$sql = "SELECT product_id,category_id,give_date,emp_id,ref_no,price,brance_code,quantity from pro_given where chalan = $chalan";
  		$run = mysqli_query($db_con,$sql);
  		$result = mysqli_fetch_assoc($run);
  		$brance_code = $result["brance_code"];
  		$product_id = $result["product_id"];
  		$category_id = $result["category_id"];
  		$emp_id = $result["emp_id"];
  		$give_date = $result["give_date"];
  		$ref_no = $result["ref_no"];

        
    ?>

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
       <div id="content" class="span10">  

       	<a href="advoice_search.php?chalan=<?php echo $chalan ?>" style="background: #375ede; color: white; font-size: 18px; padding: 5px; border-radius: 3px;">advoice</a>


			<div class="chalan">
				<div class="chalan_header">
				<?php
				echo "<center>";
				echo "<font size=6>";
				echo "রূপালী ব্যাংক লিমিটেড";
				echo "</font>";
				echo "</center>";
				?>
				</div>

				<div class="chalan_header1">
				<?php
				echo "<center>";
				echo "<font size=5>";
				echo "জোনাল অফিস, দিনাজপুর";
				echo "</font>";
				echo "</center>";
				echo "<br>";
				?>
				</div>
				<div class="left_up">
				<?php
					$sql_brance = "SELECT brance_name FROM brance_info where brance_code = $brance_code";
					$run_brance = mysqli_query($db_con,$sql_brance);
					$result_brance = mysqli_fetch_assoc($run_brance);
					$brance_name = $result_brance["brance_name"];

					$sql_emp = "SELECT emp_name FROM emp_table where emp_id = $emp_id";
					$run_emp = mysqli_query($db_con,$sql_emp);
					$result_emp = mysqli_fetch_assoc($run_emp);
					$emp_name = $result_emp["emp_name"];
				echo "প্রধান কার্যালয়, ঢাকা";
				echo "<br>";
				echo  $brance_name." শাখা সমীপে";
				echo "<br>";
				echo $emp_name." মারফত পাঠান হইল";
				?>
				</div>


				<div class="right_up">
				<?php
				echo "চালান নংঃ".$chalan;
				echo "<br>";
				echo "তারিখঃ".$give_date;
				echo "<br>";
				echo "বরাত নংঃ  "."zod/".$brance_code."/".date("Y")."/".$ref_no."";
				?>
				</div>

				<table  WIDTH="600" height="">
				  <tr>
				  <th>ক্রঃনংঃ</th>
				    <th>বিবরণ</th>
				    <th>ফরম নং</th>
				  <th>চাহিদার পরিমাণ</th>
				    <th>সরবরাহের পরিমাণ</th>
				  <th>দর</th>
				    <th>মোট মূল্য</th>
				  <th>এল.পি</th>
				  </tr>
				        <?php
				        $sql = "SELECT product_id,category_id,give_date,emp_id,ref_no,price,brance_code,quantity,unit_price from pro_given where chalan = $chalan";
					  		$run = mysqli_query($db_con,$sql);
					  		$i=1;
							while($result = mysqli_fetch_assoc($run)) {
				         ?>
				            <tr>
				              <td><?php echo $i; $i++; ?></td>

				              <?php
				              	$sql_category = "SELECT category_name FROM category where category_id = $category_id";

				              	 $run_cat=mysqli_query($db_con,$sql_category);
						        $result_cat = mysqli_fetch_assoc($run_cat);
						        $category_name = $result_cat["category_name"];

						        $sql_product = "SELECT product_name FROM product where product_id = $product_id";

				              	 $run_pro=mysqli_query($db_con,$sql_product);
						        $result_pro = mysqli_fetch_assoc($run_pro);
						        $product_name = $result_pro["product_name"];



				               ?>


				                <td><?php echo $category_name.' '.$product_name; 



				                ?></td>
				                <td> </td>
				               <td> </td>
				                <td><?php echo $result["quantity"] ?></td> 
				              <td><?php echo $result["unit_price"]; ?></td>  
				                <td><?php echo $result["price"]; ?></td>
				              <td></td>
				            </tr>
				          <?php } ?>
				  
				      <tr>
				            <?php
				                  $sql4="SELECT sum(price)as total2 from pro_given where chalan='$chalan'";
				             $run4 = mysqli_query($db_con,$sql4);
				             $result4 = mysqli_fetch_assoc($run4);
				             $total = $result4["total2"];
				             ?>
				  
				     <th colspan="6">মোট</th>
				  <td colspan="2"><?php echo $total; ?></td>
				  </tr>
				</table>

				<div class="right_down1">
				<?php
				echo ".......................................";
				echo "<br>";
				echo "ভারপ্রাপ্ত অফিসারের স্বাক্ষর";
				?>
				</div>



				<div class="right_down2">
				<?php
				echo "<hr>";
				echo "উপরোল্লিখিত জিনিসপত্র ভাল অবস্থায় ঠিকমত গুনিয়া বুঝিয়া পাইলাম";
				echo "<br>";
				echo "তাংঃ";
				echo "........................................";
				echo "<br>";
				echo "<p>........................................<p>";
				echo "<br>";
				echo "<p>দস্তখত <p>";
				?>
				</div>
				</div>
		
		</div><!--/.fluid-container-->
				  
				      <!-- end: Content -->
    </div><!--/#content.span10-->
    </div><!--/fluid-row-->
    
 

</body>
</html>