<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['report'])){

    $customerID = $_POST['customer'];
    $productID = $_POST['product'];
    
    $query = "SELECT total FROM `sales` WHERE customerID = '$customerID' AND productID = '$productID'";
    $query2 = "SELECT amountPaid FROM `payments` WHERE customerID = '$customerID' AND productID = '$productID'";
    $query3 = "SELECT total FROM `sales`";
    $query4 = "SELECT amountPaid FROM `payments`";
    
   
    
    $resultSet1 = $connection->query($query);
    $resultSet2 = $connection->query($query2);
    $resultSet3 = $connection->query($query3);
    $resultSet4 = $connection->query($query4);

    $generaltotal= 0;
    $generalAmountPaid = 0;
    $totalAmount = 0;
    $amountPaid = 0;

    
    if($resultSet1->rowCount() > 0){
        foreach($resultSet1 as $result){
            $totalAmount += $result['total'];
        }
    }
    
    if($resultSet2->rowCount() > 0){
        foreach($resultSet2 as $result){
            
            $amountPaid += $result['amountPaid'];
        }
    }

    if($resultSet3->rowCount() > 0){
        foreach($resultSet3 as $result){
            $generaltotal += $result['total'];
        }
    }
    
    if($resultSet4->rowCount() > 0){
        foreach($resultSet4 as $result){
            
            $generalAmountPaid += $result['amountPaid'];
        }
    }
    
    //checking for balance type (debit or credit)
    if($generalAmountPaid - $generaltotal >= 0){
        $balanceType = "Debit [Paying-Out]";
    }else{
        $balanceType = "Credit [Coming-In]";
    }

    if($amountPaid - $totalAmount >= 0){
        $balanceType2 = "Debit [Paying-Out]";
    }else{
        $balanceType2 = "Credit [Coming-In]";
    }

    $response = array(
        "status" => true,
        "totalAmount" => $totalAmount,
        "amountPaid" => $amountPaid,
        "eachBalance" => $amountPaid - $totalAmount,
        "generalTotal" => $generaltotal,
        "generalAmountPaid" => $generalAmountPaid,
        "balance" => $generalAmountPaid - $generaltotal,
        "balanceType" => $balanceType,
        "balanceType2" => $balanceType2
        
    );

}else{
    $response = array(
        "status" => false,
        "totalAmount" => $totalAmount,
        "amountPaid" => $amountPaid,
        "eachBalance" => $amountPaid - $totalAmount,
        "generalTotal" => $generaltotal,
        "generalAmountPaid" => $generalAmountPaid,
        "balance" => $generalAmountPaid - $generaltotal,
        "balanceType" => $balanceType,
        "balanceType2" => $balanceType2
    );      
}
echo json_encode($response);

?>