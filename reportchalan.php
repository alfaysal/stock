
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
        $sql="SELECT chalan from pro_given where pro_giv_id=(select max(pro_giv_id) from pro_given where zone_code='".$_SESSION["zone_code"]."')";
        $run=mysqli_query($db_con,$sql);
        $result = mysqli_fetch_assoc($run);
        $chalan = $result["chalan"];

        $sql2="SELECT bi.brance_name,pg.give_date,pg.emp_id,pg.ref_no from pro_given pg inner join brance_info bi
               where pg.brance_code=bi.brance_code  
               and pg.chalan='$chalan'";

         $sql_br_code="SELECT bi.brance_code from pro_given pg inner join brance_info bi
               where pg.brance_code=bi.brance_code  
               and pg.chalan='$chalan'";

        $sqlemp="SELECT e.emp_name from emp_table e where e.emp_id 
in (select distinct(pg1.emp_id) from pro_given pg1 where pg1.chalan='$chalan')";

        $run2=mysqli_query($db_con,$sql2);
        $result2 = mysqli_fetch_assoc($run2);
        $brance_code = $result2["brance_name"];
        $give_date = $result2["give_date"];
        $ref_no = $result2["ref_no"];


        $run_br_code=mysqli_query($db_con,$sql_br_code);
        $result_br_code = mysqli_fetch_assoc($run_br_code);
        $brance = $result_br_code["brance_code"];

        $runemp=mysqli_query($db_con,$sqlemp);
        $resultemp = mysqli_fetch_assoc($runemp);
        $emp_id = $resultemp["emp_name"];
        
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

       	<a href="advoice.php" style="background: #375ede; color: white; font-size: 18px; padding: 5px; border-radius: 3px;">get advoice</a>


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
				echo "প্রধান কার্যালয়, ঢাকা";
				echo "<br>";
				echo  $brance_code." শাখা সমীপে";
				echo "<br>";
				echo $emp_id." মারফত পাঠান হইল";
				?>
				</div>


				<div class="right_up">
				<?php
				echo "চালান নংঃ".$chalan;
				echo "<br>";
				echo "তারিখঃ".$give_date;
				echo "<br>";
				echo "বরাত নংঃ  "."zod/".$brance."/".date("Y")."/".$ref_no."";
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
				             $sql3="SELECT c.category_name,p.product_name, pg.quantity, pg.lot, (lot*quantity) total 
				                    from pro_given pg
				                    inner join category c
				                    on pg.category_id=c.category_id
				                    inner join product p 
				                    on pg.product_id=p.product_id
				                    where chalan='$chalan'";
				              $i=1;
				             $run3 = mysqli_query($db_con,$sql3);
				             while($result3 = mysqli_fetch_assoc($run3)) {
				         ?>
				            <tr>
				              <td><?php echo $i; $i++; ?></td>
				                <td><?php echo $result3["category_name"].' '.$result3["product_name"]; ?></td>
				                <td> </td>
				               <td> </td>
				                <td><?php echo $result3["quantity"] ?></td> 
				              <td><?php echo $result3["lot"]; ?></td>  
				                <td><?php echo $result3["total"]; ?></td>
				              <td></td>
				            </tr>
				          <?php } ?>
				  
				      <tr>
				            <?php
				                  $sql4="SELECT sum(lot*quantity)as total2 from pro_given where chalan='$chalan'";
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