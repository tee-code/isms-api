<?php

//headers
require("../headers.php");
require("../connection.php");


$db = new Database();
$connection = $db->connect();

$query = 'INSERT INTO `sales` SET salesLimit = :salesLimit, customerID = :customerID, price = :price, total = :total,productID = :productID, addedBy = :addedBy, quantity = :quantity, date = :date';

if(isset($_POST['add'])){
    $statement = $connection->prepare($query);
    
    $statement->bindValue(":productID",$_POST['productID']);
    $statement->bindValue(":quantity",$_POST['quantity']);
    $statement->bindValue(":addedBy",$_POST['addedBy']);
    $statement->bindValue(":date",$_POST['date']);
    $statement->bindValue(":customerID",$_POST['customerID']);
    $statement->bindValue(":salesLimit",$_POST['salesLimit']);
    $statement->bindValue(":price",$_POST['price']);
    $statement->bindValue(":total",$_POST['total']);

    $resultSet = $statement->execute();

    if($resultSet){
        $response = array(
            "status" => true,
            "message"=> "Added Successfully."
        );
    }else{
        $response = array(
            "status" => false,
            "message"=> "Not added."
        );
    }
    echo json_encode($response);
}


?>