<?php

	$connect = mysqli_connect('localhost','root','','rps');
	$output_product = '';
	$sql = "SELECT * from product where category_id= '".$_POST["categoryId"]."' order by product_name";
	$result = mysqli_query($connect,$sql);
	$output_product = '<option value="">select product</option>';
	while($row=mysqli_fetch_array($result)){
		$output_product .= '<option value="'.$row["product_id"].'">'.$row["product_name"].'</option>';
	}
	echo $output_product;


 ?>