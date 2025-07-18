<?php
session_start();

if (!isset($_SESSION['admin_name'])) {
    header("Location: user_login.php");
    exit();
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
    <!-- Navbar -->
    <?php include "admin_navbar.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar ">
                <h4 class="text-white text-center py-3">Admin Panel</h4>
                <a href="add_product.php">Add Product</a>
                <a href="add_brand.php">Add Brand</a>
                <a href="add_category.php">Add Category</a>
            </div>
            <div class="col-md-9 col-lg-10">
                <h1 class="mt-4">Admin: <?php echo $_SESSION['admin_name']; ?></h1>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS Link  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>