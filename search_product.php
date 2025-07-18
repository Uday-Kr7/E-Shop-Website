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
        <?php include 'component/navbar.php'; ?>

        <!-- Products  -->
        <div class="container mt-5">
            <div class="row g-4">
                <?php if (isset($_POST['search'])) {
                    $search_product = $_POST['search_product'];
                    $sql = "SELECT * FROM products WHERE product_keyword LIKE '%$search_product%' order by rand() limit 12";
                    $res = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $product_id = $row['product_id'];
                            $product_name = $row['product_name'];
                            $product_description = $row['product_description'];
                            $product_price = $row['product_price'];
                            $product_image1 = $row['product_img1'];

                            echo "
            <div class='col-md-3'>
                <div class='card h-100 shadow-sm d-flex flex-column'>
                    <div style='height: 250px; overflow: hidden;'>
                        <img src='./product_images/$product_image1' class='card-img-top img-fluid' style='height: 100%; object-fit: cover;' alt='$product_name'>
                    </div>
                    <div class='card-body d-flex flex-column'>
                        <h6 class='card-title fw-semibold fs-6 mb-2'>$product_name</h6>
                        <p class='card-text text-truncate' style='max-height: 40px; overflow: hidden; line-height: 1.2;'>$product_description</p>
                        <p class='card-text fw-bold text-success mt-auto mb-2'>Price: ₹$product_price/-</p>
                        <div class='d-flex justify-content-center gap-2'>
                            <a href='index.php?cart_product_id=$product_id' class='btn btn-primary btn-sm px-3 py-2'>Add to Cart</a>
                            <a href='view_product.php?product_id=$product_id' class='btn btn-outline-secondary btn-sm px-3 py-2'>View Item</a>
                        </div>
                    </div>
                </div>
            </div>
            ";
                        }
                    } else {
                        echo "
            <div class='col-md-12'>
                <div class='card h-100 shadow-sm d-flex flex-column'>
                    <div class='card-body d-flex flex-column'>
                        <h2 class='card-title fw-semibold fs-6 mb-2'>No Product Found</h2>
                    </div>
                </div>
            </div>
            ";
                    }
                } ?>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS Link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>