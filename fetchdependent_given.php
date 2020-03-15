<?php
	
	$connect = mysqli_connect('localhost','root','','rps');
	$output = '';
	$sql = "SELECT * from brance_info where zone_code= '".$_POST["zoneId"]."' order by brance_name";
	$result = mysqli_query($connect,$sql);
	$output = '<option value="">select brance</option>';
	while($row=mysqli_fetch_array($result)){
		$output .= '<option value="'.$row["brance_code"].'">'.$row["brance_name"].'</option>';
	}
	echo $output;

 ?>