<?php

//headers
require("../headers.php");
require("../connection.php");

$db = new Database();
$connection = $db->connect();

$query = 'INSERT INTO `vendors` SET name = :name, vendorID = :vendorID, email = :email, phoneNumber = :phoneNumber, state = :state,address = :address, addedBy = :addedBy';

if(isset($_POST['add'])){
    $statement = $connection->prepare($query);
    $statement->bindValue(":name",$_POST['name']);
    $statement->bindValue(":email",$_POST['email']);
    $statement->bindValue(":phoneNumber",$_POST['phoneNumber']);
    $statement->bindValue(":vendorID",$_POST['vendorID']);
    $statement->bindValue(":address",$_POST['address']);
    $statement->bindValue(":state",$_POST['state']); 
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