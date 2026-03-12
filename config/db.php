<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "task_management";

$conn = mysqli_connect($host,$user,$password,$db);

if(!$conn){
    die("Connection failed");
}

?>