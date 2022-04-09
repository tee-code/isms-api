<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['update'])){
    
    $username = $_POST['vehicleID'];
    $query = "UPDATE `vehicles` SET name = :name, vehicleID = :vehicleID, addedBy = :addedBy, dateAdded = :dateAdded WHERE vehicleID = '$username'";

    $statement = $connection->prepare($query);
    $statement->bindValue(":name",$_POST['name']);
    $statement->bindValue(":vehicleID",$_POST['vehicleID']);
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