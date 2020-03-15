<?php

  include('server.php');

  if(isset($_POST["zone_code"]))
  {
    $entry_by = $_SESSION["user_name"];
   $connect = new PDO("mysql:host=localhost;dbname=rps", "root", "");
   for($count = 0; $count < count($_POST["zone_code"]); $count++)
   {  
    $query = "INSERT INTO pro_recive 
    (zone_code,category_id,product_id,emp_id,lot,dem_quan,quantity,price,ho_chalan,ref_no,ho_date,entry_date,entry_by,rec_status) 
    VALUES (:zone_code,:category_id,:product_id,:emp_id,:lot,:dem_quan,:quantity,:price,:ho_chalan,:ref_no,:ho_date,:entry_date,:entry_by,:rec_status)
    ";
    $statement = $connect->prepare($query);
    $statement->execute(
     array(
      ':zone_code' => $_POST["zone_code"][$count],
      ':category_id' => $_POST["category_id"][$count],
      ':product_id' => $_POST["product_id"][$count],
      ':emp_id' => $_POST["emp_id"][$count],
      ':lot' => $_POST["lot"][$count],
      ':dem_quan' => $_POST["dem_quan"][$count],
      ':quantity' => $_POST["quantity"][$count],
      ':price' => $_POST["price"][$count],
      ':ho_chalan' => $_POST["ho_chalan"][$count],
      ':ref_no' => $_POST["ref_no"][$count],
      ':ho_date' => $_POST["ho_date"][$count],
      ':entry_date' => $_POST["entry_date"][$count],
      ':entry_by' => $entry_by,
      ':rec_status' => $_POST["rec_status"][$count],
     )
    );
   }
   $result = $statement->fetchAll();
   if(isset($result))
   {
    echo 'ok';
   }
  }


?>