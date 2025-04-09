<?php

$servername="localhost";
$username="root";
$password="";
$database="product";

$conn=mysqli_connect($servername,$username,$password,$database);

if (!$conn) {
    echo "not connect".mysqli_connect_error();
}

?>