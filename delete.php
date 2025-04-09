<?php
// include database connection file
include "dbconnect.php";
//get product id bty url
$id = $_GET["id"];
//sql query to delete data from database by id
$sql = "DELETE FROM `product_list` WHERE id = $id";
//execute query
$result = mysqli_query($conn, $sql);

if ($result) {
  //if data deleted and show success message
  header("Location: index.php?msg=Data deleted successfully");
} else {
  
  echo "Failed: " . mysqli_error($conn);
}