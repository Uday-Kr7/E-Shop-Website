<?php
include "./config/db.php";
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shoping Website</title>
    <link rel="icon" href="./images/logo.jpg">

    <!-- Bootstrap Strap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .main {
            flex: 1;
        }
    </style>

<body>
    <div class="main">
        <!-- Navbar -->
        <?php include "component/navbar.php"; ?>

        <?php if (isset($_GET["product_id"]) && is_numeric($_GET["product_id"])) {
            $product_id = (int) $_GET["product_id"];

            $sql = "SELECT * FROM products WHERE product_id = $product_id";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $product = mysqli_fetch_assoc($result);

                $product_name = $product["product_name"];
                $product_description = $product["product_description"];
                $product_price = $product["product_price"];
                $product_image1 = $product["product_img1"];
                $product_image2 = $product["product_img2"];
                $product_image3 = $product["product_img3"];

                echo "
                    <div class='container my-5'>
                        <div class='row g-5 align-items-start'>
                            <!-- Product Images -->
                            <div class='col-md-5'>
                                <div class='mb-3'>
                                <img src='./product_images/$product_image1' 
                                class='img-fluid rounded shadow-sm mb-2 w-100' 
                                style='height: 400px; object-fit: cover;' 
                                alt='$product_name'>
                            </div>
                        <div class='d-flex gap-2'>
                            <img src='./product_images/$product_image2' 
                            class='img-thumbnail' 
                            style='width: 100px; height: 100px; object-fit: cover;' 
                            alt=''>
                            <img src='./product_images/$product_image3' 
                            class='img-thumbnail' 
                            style='width: 100px; height: 100px; object-fit: cover;' 
                            alt=''>
                        </div>
                    </div>

                    <!-- Product Details -->
                        <div class='col-md-7 d-flex flex-column justify-content-between' style='min-height: 400px;'>
                            <div>
                                <h3 class='mb-3'>$product_name</h3>
                                <p class='text-muted'>$product_description</p>
                                <h4 class='text-success mb-4'>Price:$product_price/-</h4>
                            </div>
                        <div class='mt-auto'>
                        <form method='GET' action='cart.php'>
                            <input type='hidden' name='cart_product_id' value='$product_id'>
                            <div class='mb-3' style='max-width: 120px;'>
                                <label for='qty' class='form-label mb-1'>Quantity</label>
                                <input type='number' name='qty' id='qty' value='1' min='1' class='form-control form-control-sm'>
                            </div>
                            <div class='d-flex gap-3'>
                                <button type='submit' class='btn btn-primary btn-sm px-3 py-2'>Add to Cart</button>
                                <a href='index.php' class='btn btn-outline-secondary px-4'>Back</a>
                            </div>
                        </form>
                        </div>

                    </div>
                </div>
            </div>";
            } else {
                echo "<div class='container my-5'><div class='alert alert-warning'>Product not found.</div></div>";
            }
        } else {
            echo "<div class='container my-5'><div class='alert alert-danger'>Invalid product ID.</div></div>";
        } ?>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>

    <!-- Bootstrap JS Link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>