<?php

$hostName="localhost";
$port=6000;
$dbUser= "root";
$dbPassword= "";
$dbName="portfolios";
// $conn = new mysqli($hostName,$dbUser,$dbPassword,$dbName,$port);
$conn = mysqli_connect($hostName,$dbUser,$dbPassword,$dbName,$port);
if ($conn->connect_errno){
    echo "failed to connect database". $conn->connect_error;
    exit();
}

?>