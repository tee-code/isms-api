<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['update'])){
    
    $id = $_POST['id'];
    
$query = 'UPDATE `quantity` SET vendorID = :vendorID, productID = :productID, addedBy = :addedBy, quantityAdded = :quantityAdded, dateAdded = :dateAdded WHERE id = '.$id;


    $statement = $connection->prepare($query);
    
    $statement->bindValue(":productID",$_POST['productID']);
    $statement->bindValue(":quantityAdded",$_POST['quantityAdded']);
    $statement->bindValue(":addedBy",$_POST['addedBy']);
    $statement->bindValue(":dateAdded",$_POST['dateAdded']);
    $statement->bindValue(":vendorID",$_POST['vendorID']);
   
    

    
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