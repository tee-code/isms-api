<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['update'])){
    
    $id = $_POST['id'];
    $query = 'UPDATE `payments` SET customerID = :customerID, amountPaid = :amountPaid, paymentMode = :paymentMode, productID = :productID, addedBy = :addedBy, date = :date WHERE id = '.$id;

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