<?php

//headers
require("../headers.php");
require("../connection.php");


$db = new Database();
$connection = $db->connect();

$query = 'INSERT INTO `quantity` SET vendorID = :vendorID, productID = :productID, addedBy = :addedBy, quantityAdded = :quantityAdded';

if(isset($_POST['add'])){
    $statement = $connection->prepare($query);
    $statement->bindValue(":productID",$_POST['productID']);
    $statement->bindValue(":quantityAdded",$_POST['quantityAdded']);
    $statement->bindValue(":addedBy",$_POST['addedBy']);
    $statement->bindValue(":vendorID",$_POST['vendorID']);

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