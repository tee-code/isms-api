<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['update'])){
    
    $username = $_POST['userID'];
    $query = "UPDATE `users` SET name = :name, userType = :userType, username = :username, addedBy = :addedBy,password = :password WHERE username = '$username'";
    
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