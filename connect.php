<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Connect</title>
</head>
<body>
<?php
include_once 'user.php';

$servername = "localhost";
$username = "root";
$password = "root";


//Create Connection 

$conn = new mysqli($servername, $username, $password);

//Check connection 

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error ."<br>");
}
echo "Connected successfully!"."<br>";

//Create Database:
$sql = "CREATE DATABASE Bookings";
if($conn->query($sql) === TRUE ){
    echo "Database created successfully"."<br>";
} else {
    //echo "Error creating database: "."<br>" .$conn ->error;
}

//Create Table:
$sql = "CREATE TABLE Bookings.Reservations (
    guest INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    hotel VARCHAR(50) NOT NULL,
    checkin INT(6) NOT NULL 
    )";

    if ($conn->query($sql) ===TRUE){
        echo "Table created successfully!";
    } else {
        echo "Error creating table :" . $conn->error;
    }


$conn->close();
?>

</body>
</html>