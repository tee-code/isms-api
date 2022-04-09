<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['update'])){
    
    $username = $_POST['driverID'];
    $query = "UPDATE `drivers` SET name = :name, motorBoy = :motorBoy, driverID = :driverID, addedBy = :addedBy, dateAdded = :dateAdded WHERE driverID = '$username'";

    $statement = $connection->prepare($query);
    $statement->bindValue(":name",$_POST['name']);
    $statement->bindValue(":driverID",$_POST['driverID']);
    $statement->bindValue(":motorBoy",$_POST['motorBoy']);
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