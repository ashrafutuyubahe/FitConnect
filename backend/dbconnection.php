<?php


$host="localhost";
$name="root";
$dbname="gymfit";
$password="";

$dbconn= mysqli_connect($host,$name,$password,$dbname);

if(!$dbconn){
 echo "<script>alert('failed to connect  to the database...');</script>";
}


?>
