<?php

//headers
require("../headers.php");
require("../connection.php");

$db = new Database();
$connection = $db->connect();

$query = 'INSERT INTO `products` SET name = :name, productID = :productID, addedBy = :addedBy';

if(isset($_POST['add'])){
    $statement = $connection->prepare($query);
    $statement->bindValue(":name",$_POST['name']);
    $statement->bindValue(":productID",$_POST['productID']);
    $statement->bindValue(":addedBy",$_POST['addedBy']);

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