<?php
// include  the database connection file

include "dbconnect.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap  csss for styling-->
    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font Awesome for icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>PHP Complete CRUD Application - Product</title>
</head>
<body>
    <!-- navbar for product -->
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:rgba(32, 193, 218, 0.45);">
        CRUD Application - Product - List
    </nav>
    <div class="container">
        <!-- alert message for success and error -->
        <?php
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
        }
        ?>
        <!-- button to asdd new product -->
        <a href="add.php" class="btn btn-dark mb-3">Add New Product</a>
        <!--- table for product list -->
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    // Fetching data from database
                    $sql = "SELECT * FROM `product_list`";
                    $result = mysqli_query($conn, $sql);
                    //showing  id from 0 to n
                    $id1 = 0;
                    //loop for fetching data from database
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <!--- display product details -->
                            <td><?php echo $id1++ ?></td>
                            <td><?php echo $row["product_name"] ?></td>
                            <td><?php echo $row["price"] ?></td>
                            <td><?php echo $row["quantity"] ?></td>
                            <td><?php echo $row["category"] ?></td>
                            <td>
                                <!-- edit button  -->
                                <a href="edit.php?id=<?php echo $row["id"] ?>" class="link-dark btn btn-succses"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                <!-- delete button  -->
                                <a href="delete.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
    </div>
    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
 </body>
</html>