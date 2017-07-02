<?php

$servername = "localhost";
$username = "id1929870_root";
$password = "12345";
$dbname = "id1929870_tempdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
    die("Connection Failed : ". mysqli_connect_error());
}
?>