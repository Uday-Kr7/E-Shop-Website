<?php

include "../function.php";

$success = false;

if (isset($_POST['add_product_btn'])) {
    $product_name = $_POST['product_name'];
    $product_keyword = $_POST['product_keyword'];
    $product_brands = $_POST['product_brands'];
    $product_categories = $_POST['product_categories'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];

    $product_img1 = $_FILES['product_img1']['name'];
    $product_img2 = $_FILES['product_img2']['name'];
    $product_img3 = $_FILES['product_img3']['name'];

    if (empty($product_name) || empty($product_keyword) || empty($product_brands) || empty($product_categories) || empty($product_description) || empty($product_price) || empty($product_img1)) {
        echo "<script>alert('All the fields are required')</script>";
    } else {
        move_uploaded_file($_FILES['product_img1']['tmp_name'], "../product_images/$product_img1");
        move_uploaded_file($_FILES['product_img2']['tmp_name'], "../product_images/$product_img2");
        move_uploaded_file($_FILES['product_img3']['tmp_name'], "../product_images/$product_img3");

        $insert_product = "INSERT INTO `products`(`product_name`, `product_keyword`, `product_description`, `product_brand`, `product_category`, `product_price`, `product_img1`, `product_img2`, `product_img3`) VALUES ('$product_name','$product_keyword','$product_description','$product_brands','$product_categories','$product_price','$product_img1','$product_img2','$product_img3')";

        $result_query = mysqli_query($conn, $insert_product);
        if ($result_query) {
            // echo "<script>alert('Successfully Inserted the Product')</script>";
            $success = true;
        } else {
            // echo "<script>alert('Failed to Insert the Product')</script>";
            $error = true;
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shoping Website</title>
  <link rel="icon" href="../images/logo.jpg">

  <!-- Bootstrap Strap Link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">


  <style>
    body {
      overflow-y: hidden;
    }

    .sidebar {
      background-color: #748873;
    }

    .sidebar a {
      color: white;
      padding: 15px;
      display: block;
      text-decoration: none;
    }

    .sidebar a:hover {
      background-color: #495057;
    }
  </style>
</head>

<body>

  <?php include "admin_navbar.php"; ?>
  <div class="container-fluid">
    <div class="row">

      <!-- Sidebar -->
      <div class="col-md-3 col-lg-2 sidebar">
        <h4 class="text-white text-center py-3">Admin Panel</h4>
        <a href="add_product.php">Add Product</a>
        <a href="add_brand.php">Add Brand</a>
        <a href="add_category.php">Add Category</a>
      </div>

      <!-- Main Content Area -->
      <div class="col-md-9 col-lg-10 p-4">
        <h3 class="mb-4">Add New Product</h3>
        <form method="POST" enctype="multipart/form-data">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Product Name</label>
              <input type="text" class="form-control" name="product_name" autocomplete="off" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Product Keyword</label>
              <input type="text" class="form-control" name="product_keyword" autocomplete="off" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Product Brand</label>
              <!-- <input type="text" class="form-control" name="product_brand" autocomplete="off" required> -->
              <select name="product_brands" class="form-select">
                <option value="">Select Brand</option>
                <?php getBrands(); ?>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Product Category</label>
              <!-- <input type="text" class="form-control" name="product_category" autocomplete="off" required> -->
              <select name="product_categories" class="form-select">
                <option value="">Select Category</option>
                <?php getCategories(); ?>
              </select>
            </div>

            <div class="col-md-12">
              <label class="form-label">Product Description</label>
              <input type="text" class="form-control" name="product_description" autocomplete="off" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Product Price (₹)</label>
              <input type="number" class="form-control" name="product_price" autocomplete="off" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Product Image 1</label>
              <input type="file" class="form-control" name="product_img1" accept="image/*" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Product Image 2</label>
              <input type="file" class="form-control" name="product_img2" accept="image/*">
            </div>

            <div class="col-md-6">
              <label class="form-label">Product Image 3</label>
              <input type="file" class="form-control" name="product_img3" accept="image/*">
            </div>

            <div class="col-12 mt-4">
              <button type="submit" class="btn btn-success w-100" name="add_product_btn">Add Product</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>

  <?php include "msg.php"; ?>

  <!-- Bootstrap JS Link  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>