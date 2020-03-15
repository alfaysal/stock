<?php

$sql = "SELECT * FROM user_table2 WHERE user_id ='".$_SESSION["user_id"]."'";
$sh = mysqli_query($db_con,$sql);
if ($sh->num_rows > 0)
{
	while($row = $sh->fetch_assoc()){
		$user_type=$row["type"];
	}
	
}

if($_SESSION["type"] != '1')
{
    //echo 'condition matched';
	//echo $user_type;
    // the above echo is just for testing
    ?>
     <script type='text/javascript'>
        window.onload = function(){
   document.getElementById("create_user_btn").style.display = "none";
   document.getElementById("user_details_btn").style.display = "none";
}
     </script>
    <?php
}

?>