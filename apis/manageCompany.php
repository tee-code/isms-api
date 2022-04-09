<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();

$query = 'SELECT * FROM `company`';

if(isset($_POST['get'])){
    $resultSet = $connection->query($query);
    
    if($resultSet->rowCount() > 0){
        $result = $resultSet->fetch(PDO::FETCH_ASSOC);

        $response = array(
            "status" => true,
            "name" => $result['name'],
            "email" => $result['email'],
            "phoneNumber1" => $result['phoneNumber1'],
            "phoneNumber2" => $result['phoneNumber2'],
            "address" => $result['address'],
            "companyID" => $result['companyID'],
        );
    }else{
        $response = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}


?>