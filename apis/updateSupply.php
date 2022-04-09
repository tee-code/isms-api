<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['update'])){
    
    $username = $_POST['id'];
    $query = "UPDATE `supply` SET  driverID = :driverID,vehicleID = :vehicleID,destination = :destination, loads = :loads,cost = :cost,allowance = :allowance,price = :price,productID = :productID, addedBy = :addedBy, quantity = :quantity, date = :date WHERE id = '$username'";

    $statement = $connection->prepare($query);
    $fields = ['driverID','vehicleID','destination','loads','cost','allowance','price','productID','addedBy','quantity','date'];
    foreach($fields as $field){
        $statement->bindValue(":".$field,$_POST[$field]);
    }
    

    
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