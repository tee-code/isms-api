<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['update'])){
    
    $username = $_POST['customerID'];
    $query = "UPDATE `customers` SET name = :name, customerID = :customerID, email = :email, phoneNumber = :phoneNumber, state = :state,address = :address, addedBy = :addedBy, dateAdded = :dateAdded WHERE customerID = '$username'";
    
    $statement = $connection->prepare($query);
    $statement->bindValue(":name",$_POST['name']);
    $statement->bindValue(":email",$_POST['email']);
    $statement->bindValue(":phoneNumber",$_POST['phoneNumber']);
    $statement->bindValue(":customerID",$_POST['customerID']);
    $statement->bindValue(":address",$_POST['address']);
    $statement->bindValue(":state",$_POST['state']); 
    $statement->bindValue(":addedBy",$_POST['addedBy']);
    $statement->bindValue(":dateAdded",$_POST['dateAdded']);
    
    $resultSet = $statement->execute();

    if($resultSet){
        $response = array(
            "status" => true,
            "message" => "Updated Successfully"
        );
    }

        
    else{
        $response = array(
            "status" => false,
            "message"=> "Not updated"
        );
    }
    echo json_encode($response);

}


?>