<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();



if(isset($_POST['check']) && $_POST['check'] == true){
    $username = $_POST['username'];
    $token = $_POST['token'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    
    $statement = $connection->query($query);
    $numOfRows = $statement->rowCount();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    
    if($numOfRows > 0 && $token == $result['password']){
        $response = array(
            "status" => true,
            "message"=> "Valid user",
        );
    }else{
        $response = array(
            "status" => false,
            "message"=> "You are not a valid user"
        );
    }
    echo json_encode($response);
}


?>