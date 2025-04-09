<?php
// define('DB_SERVER', 'localhost');
$servername="localhost";
$username="root";
$password="";
$database="product";

// Create connection
$conn=mysqli_connect($servername,$username,$password,$database);

if (!$conn) {
    // Connection failed and show error message
    echo "not connect".mysqli_connect_error();
}

?>