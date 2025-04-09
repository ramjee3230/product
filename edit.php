<?php
include "dbconnect.php";

$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];

    $errors = [];
    
    if (empty($product_name)) {
        $errors[] = "Product Name is required";
    }

    if (empty($price) || !is_numeric($price) || $price <= 0) {
        $errors[] = "Price is required";
    }

    if (empty($quantity) || !is_numeric($quantity) || $quantity <= 0) {
        $errors[] = "Quantity is required";
    }

    if (empty($category)) {
        $errors[] = "Category is required";
    }

    if (empty($errors)) {

        $check_sql = "SELECT * FROM `product_list` WHERE product_name='$product_name' AND id != $id";

        $check_sql_result = mysqli_query($conn, $check_sql);
        
        if (null !== mysqli_fetch_assoc($check_sql_result)) {
            $errors[] = "Product already exists";
        } else {

            $sql = "UPDATE `product_list` SET `product_name`='$product_name',`price`='$price',`quantity`='$quantity',`category`='$category' WHERE id=$id";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: index.php?msg=Data updated successfully");
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
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>PHP CRUD Application</title>

</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:rgba(32, 193, 218, 0.45);">
        PHP Product Application - Edit Product
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit Product Details</h3>
        </div>

        <?php
        $sql = "SELECT * FROM `product_list` WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <?php if (!empty($errors)) { ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error) { ?>
                                <li><?php echo $error ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Product Namecd :</label>
                        <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name'] ?>" placeholder="Enter a Product Name">
                    </div>

                    <div class="col">
                        <label class="form-label">Price:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter Price" name="price" value="<?php echo $row['price'] ?>">
                            <span class="input-group-text">$</span>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col">
                        <label class="form-label">Quantity:</label>
                        <input type="number" class="form-control" name="quantity" value="<?php echo $row['quantity'] ?>" placeholder="Enter Quantity">
                    </div>
                    <div class="col">
                        <label class="form-label">Category:</label>
                        <input type="text" class="form-control" value="<?php echo $row['category'] ?>" name="category" placeholder="Enter a Category">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="submit">Save</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>