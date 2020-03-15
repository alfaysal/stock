<?php

  if(isset($_POST["product_name"]))
  {
   $connect = new PDO("mysql:host=localhost;dbname=rps", "root", "");
   $order_id = uniqid();
   for($cat = 0; $cat < count($_POST["product_name"]); $cat++)
   {  
    $query = "INSERT INTO product 
    (product_name, product_description, category_id) 
    VALUES (:product_name, :product_description, :category_id)
    ";
    $statement = $connect->prepare($query);
    $statement->execute(
     array(
      ':product_name'  => $_POST["product_name"][$cat], 
      ':product_description' => $_POST["product_description"][$cat], 
      ':category_id'  => $_POST["category_id"][$cat]
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