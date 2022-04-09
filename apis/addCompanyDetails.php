<?php

//headers
require("../headers.php");
require("../connection.php");

$db = new Database();
$connection = $db->connect();

$query = 'INSERT INTO `company` SET name = :name, email = :email, companyID = :companyID, phoneNumber1 = :phoneNumber1, phoneNumber2 = :phoneNumber2,address = :address';

if(isset($_POST['add'])){
    $statement = $connection->prepare($query);

    $companyID = password_hash($_POST['name'],PASSWORD_DEFAULT);
    $statement->bindValue(":name",$_POST['name']);
    $statement->bindValue(":email",$_POST['email']);
    $statement->bindValue(":phoneNumber1",$_POST['phoneNumber1']);
    $statement->bindValue(":phoneNumber2",$_POST['phoneNumber2']);
    $statement->bindValue(":address",$_POST['address']);
    $statement->bindValue(":companyID",$_POST['companyID']);

    $resultSet = $statement->execute();

    if($resultSet){
        $response = array(
            "status" => true,
            "message" => "Added Successfully.",
            "companyID" => $companyID,
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