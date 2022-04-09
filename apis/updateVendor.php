<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['update'])){
    
    $username = $_POST['vendorID'];
    $query = "UPDATE `vendors` SET name = :name, vendorID = :vendorID, email = :email, phoneNumber = :phoneNumber, state = :state,address = :address, addedBy = :addedBy, dateAdded = :dateAdded WHERE vendorID = '$username'";
    
    $statement = $connection->prepare($query);
    $statement->bindValue(":name",$_POST['name']);
    $statement->bindValue(":email",$_POST['email']);
    $statement->bindValue(":phoneNumber",$_POST['phoneNumber']);
    $statement->bindValue(":vendorID",$_POST['vendorID']);
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