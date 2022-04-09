<?php

//headers
require("../headers.php");
require("../connection.php");

$db = new Database();
$connection = $db->connect();

$query = 'INSERT INTO `mapping` SET vehicleID = :vehicleID, driverID = :driverID, mappedBy = :mappedBy';

if(isset($_POST['map'])){
    $statement = $connection->prepare($query);
    $statement->bindValue(":driverID",$_POST['driverID']);
    $statement->bindValue(":vehicleID",$_POST['vehicleID']);
    $statement->bindValue(":mappedBy",$_POST['mappedBy']);

    $resultSet = $statement->execute();

    if($resultSet){
        $response = array(
            "status" => true,
            "message"=> "Mapped Successfully."
        );
    }else{
        $response = array(
            "status" => false,
            "message"=> "Not Mapped."
        );
    }
    echo json_encode($response);
}


?>