<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['update'])){
    
    $username = $_POST['productID'];
    $query = "UPDATE `products` SET name = :name, productID = :productID, addedBy = :addedBy, dateAdded = :dateAdded WHERE productID = '$username'";

    $statement = $connection->prepare($query);
    $statement->bindValue(":name",$_POST['name']);
    $statement->bindValue(":productID",$_POST['productID']);
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