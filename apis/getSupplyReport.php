<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['report'])){

    $driverID = $_POST['driver'];
    $productID = $_POST['product'];
    $vehicleID = $_POST['vehicle'];
    
    
    //requested fields initially set to zero
    $loads = 0;
    $quantity = 0;
    $cost = 0;
    $allowance = 0;
    $income = 0;
    $total = 0;
    $remaining = 0;

    //several conditions to follow before fetching data from the database

    if($driverID == "all" && $productID == "all" && $vehicleID == "all"){
        $query = "SELECT total,loads,quantity,cost,allowance FROM `supply`";    
    }else if($driverID == "all" && $productID == "all" && $vehicleID != "all"){
        $query = "SELECT total,loads,quantity,cost,allowance FROM `supply` WHERE vehicleID = '$vehicleID'";
    }else if($driverID != "all" && $productID != "all" && $vehicleID == "all"){
        $query = "SELECT total,loads,quantity,cost,allowance FROM `supply` WHERE driverID = '$driverID' AND productID = '$productID'";
    }else if($driverID == "all" && $productID != "all" && $vehicleID == "all"){
        
        $query2 = "SELECT quantity FROM `sales` WHERE customerID = 'Truck111' AND productID = '$productID'";
        $resultSet2 = $connection->query($query2);
        foreach($resultSet2 as $result){
            $remaining += $result['quantity'];
        }
        $query = "SELECT total,loads,quantity,cost,allowance FROM `supply` WHERE productID = '$productID'";
    }else if($driverID == "all" && $productID != "all" && $vehicleID != "all"){
        $query = "SELECT total,loads,quantity,cost,allowance FROM `supply` WHERE productID = '$productID' AND vehicleID = '$vehicleID'";
    }else if($driverID != "all" && $productID == "all" && $vehicleID == "all"){
        $query = "SELECT total,loads,quantity,cost,allowance FROM `supply` WHERE driverID = '$driverID'";
    }else if($driverID != "all" && $productID == "all" && $vehicleID != "all"){
        $query = "SELECT total,loads,quantity,cost,allowance FROM `supply` WHERE driverID = '$driverID' AND vehicleID = '$vehicleID'";
    }
    else{
        $query = "SELECT total,loads,quantity,cost,allowance FROM `supply` WHERE productID = '$productID' AND driverID = '$driverID' AND vehicleID = '$vehicleID'";
    }

    
    
    $resultSet = $connection->query($query);
    
    if($resultSet->rowCount() > 0){
        foreach($resultSet as $result){
            $loads += $result['loads'];
            $quantity += $result['quantity'];
            $cost += $result['cost'];
            $allowance += $result['allowance'];
            $total += $result['total'];
        }
    }

    

    $response = array(
        "status" => true,
        "loads" => $loads,
        "quantity" => $quantity,
        "cost" => $cost,
        "allowance" => $allowance,
        "income" => $cost - ($total + $allowance),
        "remaining" => $remaining - $quantity
    );
   
}else{
    $response = array(
        "status" => true,
        "loads" => $loads,
        "quantity" => $quantity,
        "cost" => $cost,
        "allowance" => $allowance,
        "income" => $cost - ($total + $allowance),
        "remaining" => $remaining
    );
}  
echo json_encode($response);

?>