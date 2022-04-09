<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['delete'])){
    
    $username = $_POST['id'];

    $query = "DELETE FROM `sales` WHERE id = '$username'";
    
    $resultSet = $connection->query($query);
    
    if($resultSet){
        $response = array(
            "status" => true,
            "message" => "Deleted Successfully"
        );
    }

        
    else{
        $response = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);

}


?>