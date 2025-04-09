<?php
// include database connection file
include "dbconnect.php";
//check form submitted

if (isset($_POST["submit"])) {
    //resive data form post method
    //and store in variable
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];

    $errors = [];
    //vslidatin product name
    if (empty($product_name)) {
        $errors[] = "Product Name is required";
    }
    //validation for price
    if (empty($price) || !is_numeric($price) || $price <= 0) {
        $errors[] = "Price is required";
    }
    //validation for quntity
    if (empty($quantity) || !is_numeric($quantity) || $quantity <= 0 ||$quantity>=100) {
        $errors[] = "Quantity is required";
    }
    //validation for category
    if (empty($category)) {
        $errors[] = "Category is required";
    }
    if (empty($errors)) {
        //chech if product name alreaddy exists in database 
        $check_sql = "SELECT * FROM `product_list` WHERE product_name='$product_name'";
        $check_sql_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_sql_result) > 0) {
            //error for data match
            $errors[] = "Product already exists";
        } else {
            //insert new data in database

            $sql = "INSERT INTO `product_list` (`id`, `product_name`, `price`, `quantity`, `category`) VALUES (NULL, '$product_name', '$price', '$quantity', '$category');";
            //execute query
            $result = mysqli_query($conn, $sql);

            if ($result) {
                //if data inserted successfully and index.php page open
                //and show success message
                header("Location: index.php?msg=New record created successfully");
                exit();
            } else {
                $errors[] = "Failed: " . mysqli_error($conn);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap and css -->
    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>PHP Complete CRUD Application - Product</title>
</head>

<body>
    <!-- navbar for product -->
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:rgba(32, 193, 218, 0.45);">
        PHP CRUD Application - Product
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Add Product Deteil</h3>
        </div>


        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <!--- display validation error -->
                <?php if (!empty($errors)) { ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error) { ?>
                                <li><?php echo $error ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <!-- product name, price, quantity and category form -->
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Product Name:</label>
                        <input type="text" class="form-control" name="product_name" placeholder="Enter a Product Name">
                    </div>

                    <div class="col">
                        <label class="form-label">Price:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter Price" name="price">
                            <span class="input-group-text">$</span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label class="form-label">Quantity:</label>
                        <input type="number" class="form-control" name="quantity" placeholder="Enter Quantity">
                    </div>
                    <div class="col">
                        <label class="form-label">Category:</label>
                        <input type="text" class="form-control" name="category" placeholder="Enter a Category">
                    </div>
                </div>
                <div>
                            <!-- form submit and cancel button -->
                    <button type="submit" class="btn btn-success" name="submit">Save</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>