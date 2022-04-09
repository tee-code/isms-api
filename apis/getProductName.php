<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if($_POST['product']){

    $id = $_POST['productID'];
    $query = "SELECT name FROM `products` WHERE productID = '$id'";

    $resultSet = $connection->query($query);
    if($resultSet->rowCount() > 0){
        $result = $resultSet->fetch(PDO::FETCH_ASSOC);

        $response = array(
            "status" => true,
            "productName"=>$result['name']
        );
    }else{
        $response = array(
            "status" => false,
            "productName"=>"Not Found"
        );
    }
}
    echo json_encode($response);

?>