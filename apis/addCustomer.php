<?php

//headers
require("../headers.php");
require("../connection.php");


$db = new Database();
$connection = $db->connect();

$query = 'INSERT INTO `customers` SET name = :name, isTruck = :isTruck, customerID = :customerID, email = :email, phoneNumber = :phoneNumber, state = :state,address = :address, addedBy = :addedBy';

if(isset($_POST['add'])){
    $statement = $connection->prepare($query);
    $statement->bindValue(":name",$_POST['name']);
    $statement->bindValue(":email",$_POST['email']);
    $statement->bindValue(":phoneNumber",$_POST['phoneNumber']);
    $statement->bindValue(":customerID",$_POST['customerID']);
    $statement->bindValue(":address",$_POST['address']);
    $statement->bindValue(":state",$_POST['state']); 
    $statement->bindValue(":addedBy",$_POST['addedBy']);
    $statement->bindValue(":isTruck",$_POST['isTruck']);

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