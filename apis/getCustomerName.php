<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if($_POST['customer']){

    $id = $_POST['customerID'];
    $query = "SELECT name FROM `customers` WHERE customerID = '$id'";

    $resultSet = $connection->query($query);
    if($resultSet->rowCount() > 0){
        $result = $resultSet->fetch(PDO::FETCH_ASSOC);

        $response = array(
            "status" => true,
            "customerName"=>$result['name']
        );
    }else{
        $response = array(
            "status" => false,
            "customerName"=>"Not Found"
        );
    }
}

    echo json_encode($response);

?>