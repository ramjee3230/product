<?php
class database
{
    private $servername;
    private $username;
    private $password;
    private $database;

    function connect()

    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "product";

        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
        if (!$conn) {
            echo "not connecct" . mysqli_connect_errno();
        }
        return $conn;
    }
}

class product extends database

{
    function getdata()
    {
        $sql = "SELECT * FROM `product_list`";
        $result = mysqli_query($this->connect(), $sql);
        return $result;
    }

    function insertdata($data)
    {
        $product_name = $data['product_name'];
        $price = $data['price'];
        $quantity = $data['quantity'];
        $category = $data['category'];

        $sql = "INSERT INTO `product_list` (`id`, `product_name`, `price`, `quantity`, `category`) VALUES (NULL, '$product_name', '$price', '$quantity', '$category');";
        $result = mysqli_query($this->connect(), $sql);
        return $result;   
    }
    function delete($id)
    {
        $sql = "DELETE FROM `product_list` WHERE id=$id";
        $result = mysqli_query($this->connect(), $sql);

        if ($result) {
            //if data deleted and show success message
            header("Location: index.php?msg=Data deleted successfully");
        } else {
            echo "Failed: " . mysqli_connect_error();
        }
        return $result;
    }
}



class Validation
{
    private $errors = [];

    public function validateProductName($product_name)
    {
        if (empty($product_name)) {
            $this->errors[] = "Please Enter Product Name";
        } elseif (!preg_match("/^[a-zA-Z]*$/", $product_name)) {
            $this->errors[] = "Product Name must be letters only";
        }
    }

    public function validatePrice($price)
    {
        if (empty($price)) {
            $this->errors[] = "Please Enter Price";
        } elseif (!is_numeric($price)) {
            $this->errors[] = "Price must be a number between 0 and 100000";
        } elseif ($price < 0) {
            $this->errors[] = "Price must be greater than 0";
        } elseif ($price > 100000) {
            $this->errors[] = "Price must be less than 100000";
        }
    }

    public function validateQuantity($quantity)
    {
        if (empty($quantity)) {
            $this->errors[] = "Please Enter Quantity";
        } elseif (!is_numeric($quantity)) {
            $this->errors[] = "Quantity must be a number between 0 and 100";
        } elseif ($quantity < 0) {
            $this->errors[] = "Quantity must be greater than 0";
        } elseif ($quantity > 100) {
            $this->errors[] = "Quantity must be less than 100";
        }
    }

    public function validateCategory($category)
    {
        if (empty($category)) {
            $this->errors[] = "Please Enter Category";
        } elseif (!preg_match("/^[a-zA-Z ,]*$/", $category)) {
            $this->errors[] = "Category must be letters only";
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}