<?php

//headers
require("../headers.php");
require("../connection.php");


$db = new Database();
$connection = $db->connect();

$query = 'INSERT INTO `supply` SET driverID = :driverID,vehicleID = :vehicleID,destination = :destination,loads = :loads,cost = :cost,allowance = :allowance,price = :price, total = :total,productID = :productID, addedBy = :addedBy, quantity = :quantity, date = :date';

if(isset($_POST['add'])){
    $statement = $connection->prepare($query);
    $fields = ['driverID','vehicleID','destination','loads','cost','allowance','price','total','productID','addedBy','quantity','date'];
    foreach($fields as $field){
        $statement->bindValue(":".$field,$_POST[$field]);
    }

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