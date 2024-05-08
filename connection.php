<?php
$host= 'localhost';
$usernm='root';
$pass= 123;
$dbnm='learn';
$conn= new mysqli($host,$usernm,$pass,$dbnm);
if($conn->connect_error){
    exit("connection failed:".$conn->connect_error);
} 

echo "coonection is  set "


?>