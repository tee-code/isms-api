<?php

//headers
require("../headers.php");

require("../connection.php");

$db = new Database();
$connection = $db->connect();


if(isset($_POST['admin'])){
    $query = "SELECT * FROM `users` WHERE userType = 'admin'";
    $resultSet = $connection->query($query);
    
    if($resultSet->rowCount() > 0){
        
        foreach ($resultSet as $result) {
            $response[] = array(
                "status" => true,
                "name" => $result['name'],
                "adminID" => $result['username'],
                "password" => $result['password'],
                "dateJoined" => $result['dateAdded'],
                "addedBy" => $result['addedBy'],
            );
        }

        
    }else{
        $response[] = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}

if(isset($_POST['staff'])){
    $query = "SELECT * FROM `users` WHERE userType = 'staff'";
    $resultSet = $connection->query($query);
    
    if($resultSet->rowCount() > 0){
        foreach ($resultSet as $result) {
            $response[] = array(
                "status" => true,
                "name" => $result['name'],
                "staffID" => $result['username'],
                "password" => $result['password'],
                "dateJoined" => $result['dateAdded'],
                "addedBy" => $result['addedBy'],
            );
        }
    }else{
        $response[] = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}

if(isset($_POST['company'])){
    $query = "SELECT * FROM `company`";
    $resultSet = $connection->query($query);

    if($resultSet->rowCount() > 0){
        foreach ($resultSet as $result) {
            $response = array(
                "status" => true,
                "companyName" => $result['name'],
                "companyID" => $result['companyID'],
                "phonenumber1" => $result['phoneNumber1'],
                "phonenumber2" => $result['phoneNumber2'],
                "address" => $result['address'],
                "email"=>$result['email']
            );
        }
    }else{
        $response = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}

if(isset($_POST['customer'])){
    $query = "SELECT * FROM `customers`";
    $resultSet = $connection->query($query);

    if($resultSet->rowCount() > 0){
        foreach ($resultSet as $result) {
            $response[] = array(
                "status" => true,
                "name" => $result['name'],
                "customerID" => $result['customerID'],
                "phonenumber" => $result['phoneNumber'],
                "state" => $result['state'],
                "address" => $result['address'],
                "email"=>$result['email'],
                "addedBy" => $result['addedBy'],
                "dateAdded" => $result['dateAdded'],
                "isTruck" => $result['isTruck'],
            );
        }
    }else{
        $response[] = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}

if(isset($_POST['vendor'])){
    $query = "SELECT * FROM `vendors`";
    $resultSet = $connection->query($query);

    if($resultSet->rowCount() > 0){
        foreach ($resultSet as $result) {
            $response[] = array(
                "status" => true,
                "name" => $result['name'],
                "vendorID" => $result['vendorID'],
                "phonenumber" => $result['phoneNumber'],
                "state" => $result['state'],
                "address" => $result['address'],
                "email"=>$result['email'],
                "addedBy" => $result['addedBy'],
                "dateAdded" => $result['dateAdded']
            );
        }
    }else{
        $response[] = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}

if(isset($_POST['product'])){
    $query = "SELECT * FROM `products`";
    $resultSet = $connection->query($query);

    if($resultSet->rowCount() > 0){
        foreach ($resultSet as $result) {
            $response[] = array(
                "status" => true,
                "name" => $result['name'],
                "productID" => $result['productID'],
                "addedBy" => $result['addedBy'],
                "dateAdded" => $result['dateAdded']
            );
        }
    }else{
        $response[] = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}


if(isset($_POST['driver'])){
    $query = "SELECT * FROM `drivers`";
    $resultSet = $connection->query($query);

    if($resultSet->rowCount() > 0){
        foreach ($resultSet as $result) {
            $response[] = array(
                "status" => true,
                "name" => $result['name'],
                "driverID" => $result['driverID'],
                "motorBoy" => $result['motorBoy'],
                "addedBy" => $result['addedBy'],
                "dateAdded" => $result['dateAdded']
            );
        }
    }else{
        $response[] = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}
if(isset($_POST['vehicle'])){
    $query = "SELECT * FROM `vehicles`";
    $resultSet = $connection->query($query);

    if($resultSet->rowCount() > 0){
        foreach ($resultSet as $result) {
            $response[] = array(
                "status" => true,
                "name" => $result['name'],
                "vehicleID" => $result['vehicleID'],
                "addedBy" => $result['addedBy'],
                "dateAdded" => $result['dateAdded']
            );
        }
    }else{
        $response[] = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}
if(isset($_POST['quantity'])){
    $query = "SELECT * FROM `quantity`";
    $resultSet = $connection->query($query);

    if($resultSet->rowCount() > 0){
        foreach ($resultSet as $result) {
            $id2 = $result['vendorID'];
            $query2 = "SELECT name, vendorID FROM `vendors` WHERE vendorID = '$id2'";
            $resultSet2 = $connection->query($query2);
            if($resultSet2->rowCount() > 0){
                $result2 = $resultSet2->fetch(PDO::FETCH_ASSOC);
                $vendorName = $result2['name'];
                $vendorID = $result2['vendorID'];
            }else{
                $vendorName = "Not Found";
                $vendorID = "Not Found";

            }
            $id3 = $result['productID'];
            $query3 = "SELECT name, productID FROM `products` WHERE productID = '$id3'";
            $resultSet3 = $connection->query($query3);
            if($resultSet3->rowCount() > 0){
                $result3 = $resultSet3->fetch(PDO::FETCH_ASSOC);
                $productName = $result3['name'];
                $productID = $result3['productID'];
            }else{
                $productName = "Not Found";
                $productID = "Not Found";
            }
            $response[] = array(
                "status" => true,
                "quantityAdded" => $result['quantityAdded'],
                "productID" => $productID,
                "vendorID" => $vendorID,
                "productName" => $productName,
               
                "vendorName" => $vendorName,
                "addedBy" => $result['addedBy'],
                "dateAdded" => $result['dateAdded'],
                "id" => $result['id'],
            );
        }
    }else{
        $response[] = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}

if(isset($_POST['sales'])){
    $query = "SELECT * FROM `sales`";
    $resultSet = $connection->query($query);

    if($resultSet->rowCount() > 0){
        foreach ($resultSet as $result) {
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
            $response[] = array(
                "status" => true,
                "price" => $result['price'],
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
    }else{
        $response[] = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}

if(isset($_POST['payment'])){
    $query = "SELECT * FROM `payments`";
    $resultSet = $connection->query($query);

    if($resultSet->rowCount() > 0){
        foreach ($resultSet as $result) {
            $id2 = $result['customerID'];
            $query2 = "SELECT name FROM `customers` WHERE customerID = '$id2'";
            $resultSet2 = $connection->query($query2);
            if($resultSet2->rowCount() > 0){
                $result2 = $resultSet2->fetch(PDO::FETCH_ASSOC);
                $customerName = $result2['name'];
            }else{
                $customerName = "Not Found";

            }
            $id3 = $result['productID'];
            $query3 = "SELECT name FROM `products` WHERE productID = '$id3'";
            $resultSet3 = $connection->query($query3);
            if($resultSet3->rowCount() > 0){
                $result3 = $resultSet3->fetch(PDO::FETCH_ASSOC);
                $productName = $result3['name'];
            }else{
                $productName = "Not Found";
            }
            $response[] = array(
                "status" => true,
                "amountPaid" => $result['amountPaid'],
                "paymentMode" => $result['paymentMode'],
                "productName" => $productName,
                "productID" => $result['productID'],
                "customerName" => $customerName,
                "customerID" => $result['customerID'],
                "addedBy" => $result['addedBy'],
                "date" => $result['date'],
                "id" => $result['id'],
            );
        }
    }else{
        $response[] = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}

if(isset($_POST['mapping'])){
    $query = "SELECT * FROM `mapping`";
    $resultSet = $connection->query($query);

    if($resultSet->rowCount() > 0){
        foreach ($resultSet as $result) {
            $id2 = $result['driverID'];
            $query2 = "SELECT name FROM `drivers` WHERE driverID = '$id2'";
            $resultSet2 = $connection->query($query2);
            if($resultSet2->rowCount() > 0){
                $result2 = $resultSet2->fetch(PDO::FETCH_ASSOC);
                $driverName = $result2['name'];
            }else{
                $driverName = "Not Found";

            }
            $id3 = $result['vehicleID'];
            $query3 = "SELECT name FROM `vehicles` WHERE vehicleID = '$id3'";
            $resultSet3 = $connection->query($query3);
            if($resultSet3->rowCount() > 0){
                $result3 = $resultSet3->fetch(PDO::FETCH_ASSOC);
                $vehicleName = $result3['name'];
            }else{
                $vehicleName = "Not Found";
            }
            $response[] = array(
                "status" => true,
                
                "vehicleName" => $vehicleName,
                "vehicleID" => $result['vehicleID'],
                "driverName" => $driverName,
                "driverID" => $result['driverID'],
                "addedBy" => $result['mappedBy'],
                "dateAdded" => $result['dateMapped'],
                "id" => $result['id'],
            );
        }
    }else{
        $response[] = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}

if(isset($_POST['supply'])){
    $query = "SELECT * FROM `supply`";
    $resultSet = $connection->query($query);

    if($resultSet->rowCount() > 0){
        foreach ($resultSet as $result) {
            $id2 = $result['driverID'];
            $query2 = "SELECT name FROM `drivers` WHERE driverID = '$id2'";
            $resultSet2 = $connection->query($query2);
            if($resultSet2->rowCount() > 0){
                $result2 = $resultSet2->fetch(PDO::FETCH_ASSOC);
                $driverName = $result2['name'];
            }else{
                $driverName = "Not Found";

            }
            $id3 = $result['vehicleID'];
            $query3 = "SELECT name FROM `vehicles` WHERE vehicleID = '$id3'";
            $resultSet3 = $connection->query($query3);
            if($resultSet3->rowCount() > 0){
                $result3 = $resultSet3->fetch(PDO::FETCH_ASSOC);
                $vehicleName = $result3['name'];
            }else{
                $vehicleName = "Not Found";
            }
            $id4 = $result['productID'];
            $query4 = "SELECT name FROM `products` WHERE productID = '$id4'";
            $resultSet4 = $connection->query($query4);
            if($resultSet4->rowCount() > 0){
                $result4 = $resultSet4->fetch(PDO::FETCH_ASSOC);
                $productName = $result4['name'];
            }else{
                $productName = "Not Found";
            }
            $response[] = array(
                "status" => true,
                
                "vehicleName" => $vehicleName,
                "vehicleID" => $result['vehicleID'],
                "driverName" => $driverName,
                "driverID" => $result['driverID'],
                "productName" => $productName,
                "productID" => $result['driverID'],
                "addedBy" => $result['addedBy'],
                "destination" => $result['destination'],
                "loads" => $result['loads'],
                "cost" => $result['cost'],
                "allowance" => $result['allowance'],
                "quantity" => $result['quantity'],
                "price" => $result['price'],
                "total" => $result['total'],
                "netIncome" => $result['cost'] - ($result['total'] + $result['allowance']),
                "date" => $result['date'],
                "id" => $result['id'],
            );
        }
    }else{
        $response[] = array(
            "status" => false,
            "message"=> "empty"
        );
    }
    echo json_encode($response);
}

?>
