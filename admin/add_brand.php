<?php

include "../config/db.php";
$success = false;

if (isset($_POST['add_brand_btn'])) {
    $brand_name = $_POST['brand_name'];

    if (empty($brand_name)) {
        echo "<script>alert('Brand name is required')</script>";
    } else {
        $insert_query = "INSERT INTO `brands`(`brand_name`) VALUES ('$brand_name')";
        $insert_query_result = mysqli_query($conn, $insert_query);

        if ($insert_query_result) {
            // echo "<script>alert('Brand added successfully')</script>";
            $success = true;
        } else {
            // echo "<script>alert('Brand not added successfully')</script>";
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
            min-height: 88.5vh;
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
                <h3 class="mb-4">Add New Brand</h3>
                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Add Brand</label>
                            <input type="text" class="form-control" name="brand_name" autocomplete="off" required>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success w-100" name="add_brand_btn">Add Brand</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- Toast Container -->
    <div class="position-fixed top-0 end-0 p-3 mt-5" style="z-index: 9999;">

        <!-- Success Toast -->
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ✅ Brand added successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>

        <!-- Error Toast -->
        <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ❌ Brand not added successfully!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>

    </div>


    <!-- Trigger Toasts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($success): ?>
                var toastEl = document.getElementById('successToast');
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 1000,
                    autohide: true
                });
                toast.show();
            <?php elseif ($error): ?>
                var toastEl = document.getElementById('errorToast');
                var toast = new bootstrap.Toast(toastEl, {
                    delay: 1000,
                    autohide: true
                });
                toast.show();
            <?php endif; ?>
        });
    </script>

    <!-- Bootstrap JS Link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>