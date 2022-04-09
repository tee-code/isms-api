<?php

//headers
require("../headers.php");
require("../connection.php");


$db = new Database();
$connection = $db->connect();

$query = 'INSERT INTO `payments` SET customerID = :customerID, amountPaid = :amountPaid, paymentMode = :paymentMode, productID = :productID, addedBy = :addedBy, date = :date';

if(isset($_POST['add'])){
    $statement = $connection->prepare($query);
    
    $statement->bindValue(":productID",$_POST['productID']);
    $statement->bindValue(":addedBy",$_POST['addedBy']);
    $statement->bindValue(":date",$_POST['date']);
    $statement->bindValue(":customerID",$_POST['customerID']);
    
    $statement->bindValue(":paymentMode",$_POST['paymentMode']);
    $statement->bindValue(":amountPaid",$_POST['amountPaid']);

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