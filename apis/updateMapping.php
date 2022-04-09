<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['update'])){
    
    $username = $_POST['id'];
    $query = "UPDATE `mapping` SET dateMapped = :dateMapped, vehicleID = :vehicleID, driverID = :driverID, mappedBy = :mappedBy WHERE id = '$username'";

    $statement = $connection->prepare($query);
    $statement->bindValue(":driverID",$_POST['driverID']);
    $statement->bindValue(":vehicleID",$_POST['vehicleID']);
    $statement->bindValue(":mappedBy",$_POST['mappedBy']);
    $statement->bindValue(":dateMapped",$_POST['dateMapped']);
    

    
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