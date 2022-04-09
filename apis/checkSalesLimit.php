<?php

    //headers
    require("../headers.php");

    require("../connection.php");

    $db = new Database();
    $connection = $db->connect();

    if($_POST['check']){
        $now = date("Y-m-d");
        $date = date_create($now);

        $query = 'SELECT * FROM `sales`';
        $resultSet = $connection->query($query);
        $response = [];
        if($resultSet->rowCount() > 0){
            
            foreach($resultSet as $result){
                $id2 = $result['customerID'];
                $query2 = "SELECT * FROM `customers` WHERE customerID = '$id2'";
                $resultSet2 = $connection->query($query2);
                if($resultSet2->rowCount() > 0){
                    $result2 = $resultSet2->fetch(PDO::FETCH_ASSOC);
                    $customerName = $result2['name'];
                    $customerID = $result2['customerID'];
                }else{
                    $customerName = "Not Found";
                    $customerID = "Not Found";
                }
                $id3 = $result['productID'];
                $query3 = "SELECT * FROM `products` WHERE productID = '$id3'";
                $resultSet3 = $connection->query($query3);
                if($resultSet3->rowCount() > 0){
                    $result3 = $resultSet3->fetch(PDO::FETCH_ASSOC);
                    $productName = $result3['name'];
                    $productID = $result3['productID'];
                }else{
                    $productName = "Not Found";
                    $productID = "Not Found";
                }
                $diff = date_diff(date_create($result['date']),$date);
                if($result['salesLimit'] - $diff->format("%a") <= 2){
                    $response[] = array(
                        "status" => true,
                        "price" => $result['price'],
                        "daysRemaining" => $result['salesLimit'] - $diff->format("%a"),
                        "salesLimit" => $result['salesLimit'],
                        "quantity" => $result['quantity'],
                        "total" => $result['price'] * $result['quantity'],
                        "productName" => $productName,
                        "productID" => $result['productID'],
                        "customerName" => $customerName,
                        "customerID" => $result['customerID'],
                        "addedBy" => $result['addedBy'],
                        "date" => $result['date'],
                        "id" => $result['id'],
                    );
                }
                
            }
        }else{
            $response[] = array(
                "status" => false,
                "message" => "Not found"
            );
        }
        echo json_encode($response);   
    }