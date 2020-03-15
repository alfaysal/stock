<?php

  include('server.php');

  if(isset($_POST["zone_code"]))
  {
    $given_by = $_SESSION["user_name"];
   $connect = new PDO("mysql:host=localhost;dbname=rps", "root", "");
   for($count = 0; $count < count($_POST["zone_code"]); $count++)
   {  
    $query = "INSERT INTO pro_given 
    (zone_code,brance_code,category_id,product_id,lot,employee_id,chalan,hchalan,ref_no,dem_quan,quantity,price,unit_price,give_date,given_by,advice) 
    VALUES (:zone_code,:brance_code,:category_id,:product_id,:lot,:employee_id,:chalan,:hchalan,:ref_no,:dem_quan,:quantity,:price,:unit_price,:give_date,:given_by,:advice)
    ";
    $statement = $connect->prepare($query);
    $statement->execute(
     array(
      ':zone_code' => $_POST["zone_code"][$count],
      ':brance_code' => $_POST["brance_code"][$count],
      ':category_id' => $_POST["category_id"][$count],
      ':product_id' => $_POST["product_id"][$count],
      ':lot' => $_POST["lot"][$count],
      ':employee_id' => $_POST["employee_id"][$count],
      ':chalan' => $_POST["chalan"][$count],
      ':hchalan' => $_POST["hchalan"][$count],
      ':ref_no' =>$_POST["ref_no"][$count],
      ':dem_quan' =>$_POST["dem_quan"][$count],
      ':quantity' => $_POST["quantity"][$count],
      ':price' => $_POST["price"][$count],
      ':unit_price' => $_POST["unit_price"][$count],
      ':give_date' => $_POST["give_date"][$count],
      ':given_by' => $given_by,
      ':advice' =>$_POST["advice"][$count],
     )
    );
   }
   $result = $statement->fetchAll();
   if(isset($result))
   {
    echo 'ok';

   }
  }
/*
if(isset($_POST["zone_code"]))
  {
    $given_by = $_SESSION["user_name"];
   $connect = new PDO("mysql:host=localhost;dbname=rps", "root", "");
   for($count = 0; $count < count($_POST["zone_code"]); $count++)
   {  
    $query = "INSERT INTO pro_given 
    (zone_code,brance_code,category_id,product_id,lot,employee_id,chalan,hchalan,ref_no,dem_quan,quantity,price,unit_price,give_date,given_by,advice) 
    VALUES (:zone_code,:brance_code,:category_id,:product_id,:lot,:employee_id,:chalan,:hchalan,:ref_no,:dem_quan,:quantity,:price,:unit_price,:give_date,:given_by,:advice)
    ";
    $statement = $connect->prepare($query);
    $statement->execute(
     array(
      ':zone_code' => $_POST["zone_code"][$count],
      ':brance_code' => $_POST["brance_code"][$count],
      ':category_id' => $_POST["category_id"][$count],
      ':product_id' => $_POST["product_id"][$count],
      ':lot' => $_POST["lot"][$count],
      ':employee_id' => $_POST["employee_id"][$count],
      ':chalan' => $_POST["chalan"][$count],
      ':hchalan' => $_POST["hchalan"][$count],
      ':ref_no' =>$_POST["ref_no"][$count],
      ':dem_quan' =>$_POST["dem_quan"][$count],
      ':quantity' => $_POST["quantity"][$count],
      ':price' => $_POST["price"][$count],
      ':unit_price' => $_POST["unit_price"][$count],
      ':give_date' => $_POST["give_date"][$count],
      ':given_by' => $given_by,
      ':advice' =>$_POST["advice"][$count],
     )
    );
    $last_id = $connect->lastInsertId();
    $sql="SELECT chalan, brance_code, give_date, category_id, product_id, lot,quantity,(lot*price) FROM pro_given WHERE product_giv_id=$product_giv_id";
    $statement2 = $dbh->prepare($sql);
    $statement2->execute();
    while ($result = $statement2->fetch(PDO::FETCH_ASSOC)){
        echo $result['chalan'];
        echo $result['brance_code'];
        echo $result['give_date'];
    }
   }
   $result = $statement->fetchAll();
   if(isset($result))
   {
    echo 'ok';
   }
  }
*/

?>