<?php

$hostName="localhost";
$port=3306;
$dbUser= "root";
$dbPassword= "khlooody9510K";
$dbName="portfolios";
// $conn = new mysqli($hostName,$dbUser,$dbPassword,$dbName,$port);
$conn = mysqli_connect($hostName,$dbUser,$dbPassword,$dbName,$port);
if ($conn->connect_errno){
    echo "failed to connect database". $conn->connect_error;
    exit();
}
else{
    // var_dump($conn);
}

?>