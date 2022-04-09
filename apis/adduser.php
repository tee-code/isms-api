<?php

//headers
require("../headers.php");
require("../connection.php");

$db = new Database();
$connection = $db->connect();

$query = 'INSERT INTO `users` SET name = :name, userType = :userType, username = :username, addedBy = :addedBy,password = :password';

if(isset($_POST['add'])){
    $statement = $connection->prepare($query);
    $password1 = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $statement->bindValue(":name",$_POST['name']);
    $statement->bindValue(":userType",$_POST['userType']);
    $statement->bindValue(":username",$_POST['username']);
    $statement->bindValue(":addedBy",$_POST['addedBy']);
    $statement->bindValue(":password",$_POST['password']);

    $resultSet = $statement->execute();

    if($resultSet){
        $response = array(
            "status" => true,
            "message"=> "Added Successfully.",
            "username"=>$_POST['username']
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