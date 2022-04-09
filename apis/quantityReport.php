<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['report'])){
    $id = $_POST['product'];
    $query = "SELECT quantityAdded FROM quantity WHERE productID = '$id'";
    $query2 = "SELECT quantity FROM sales WHERE productID = '$id'";
    
   
    
    $resultSet1 = $connection->query($query);
    $resultSet2 = $connection->query($query2);
    

    $quantityIN = 0;
    $quantityOUT = 0;

    
    if($resultSet1->rowCount() > 0){
        foreach($resultSet1 as $result){
            $quantityIN += $result['quantityAdded'];
        }
    }
    
    if($resultSet2->rowCount() > 0){
        foreach($resultSet2 as $result){
            
            $quantityOUT += $result['quantity'];
        }
    }
    
    $response = array(
        "status" => true,
        "quantityIN" => $quantityIN,
        "quantityOUT" => $quantityOUT,
        "quantityRemaining" => $quantityIN - $quantityOUT,
        
    );

}else{
    $response = array(
        "status" => false,
        "quantityIN" => 0,
        "quantityOUT" => 0,
        "quantityRemaining" => 0,
        "names" => []
    );      
}
echo json_encode($response);

?>