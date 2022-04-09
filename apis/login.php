<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();



if(isset($_POST['login']) && $_POST['login'] == true){
    $username = $_POST['username'];
    $userType = $_POST['userType'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username = '$username' AND userType = '$userType' AND password = '$password'";
    
    $statement = $connection->query($query);
    $numOfRows = $statement->rowCount();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    
    if($numOfRows > 0){
        $response = array(
            "status" => true,
            "message"=> "Logged In Successfully.",
            "userID" => $result['username'],
            "token" => $result['password'],
            "userType" => $result['userType']
        );
    }else{
        $response = array(
            "status" => false,
            "message"=> "Invalid combinations."
        );
    }
    echo json_encode($response);
}


?>