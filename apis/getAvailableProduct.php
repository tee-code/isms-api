<?php
//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();
$quantityAvailable = 0;
if(isset($_POST['get']) && isset($_POST['productID'])){
    $id = $_POST['productID'];
    $query = "SELECT quantityAdded FROM `quantity` WHERE productID = '$id'";
    $resultSet = $connection->query($query);

    
    if($resultSet->rowCount() > 0){
        foreach($resultSet as $result){
            $quantityAvailable += $result['quantityAdded'];
        }
    }
    $response = array(
        "status" => true,
        "quantityAvailable" => $quantityAvailable
    );
}else{
    $response = array(
        "status" => false,
        "quantityAvailable" => $quantityAvailable
    );
}

echo json_encode($response);