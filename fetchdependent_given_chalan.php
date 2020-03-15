<?php

	$connect = mysqli_connect('localhost','root','','rps');
	$output_hchalan = '';
	$sql = "SELECT   rcv.ho_chalan,(COALESCE(rcv.Q1,0) - COALESCE(giv.Q2, 0))  as balance
		   from
			(select sum(quantity)as Q1,lot, ho_chalan,category_id, product_id from pro_recive where zone_code=405 group by product_id,ho_chalan) AS rcv
			left join
			(select sum(quantity) as Q2,unit_price, hchalan,category_id, product_id from pro_given where zone_code=405 group by product_id,hchalan) AS giv 
			on (rcv.product_id = giv.product_id and rcv.ho_chalan = giv.hchalan) 
			where rcv.product_id ='".$_POST["productId"]."'
		   having balance <> 0
		   order by 2 desc 
		  ";
	$result = mysqli_query($connect,$sql);
	$output_hchalan = '<option value="">select hchalan</option>';
	while($row=mysqli_fetch_array($result)){
		$output_hchalan .= '<option value="'.$row["ho_chalan"].'">'.$row["ho_chalan"].'</option>';
	}
	echo $output_hchalan;


 ?>