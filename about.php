<?php
session_start();
include "./config/db.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>About Us - Shopping Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./images/logo.jpg">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <style>
        .about-header {
            background: url('./images/about-bg.jpg') center/cover no-repeat;
            height: 300px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: bold;
        }

        .about-section {
            padding: 2rem 1rem;
            margin-top: -300px;
        }

        .icon-box {
            font-size: 2rem;
            color: #198754;
        }

        .about-img {
            max-height: 300px;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php include 'component/navbar.php'; ?>

    <!-- Header -->
    <div class="about-header">
        About Us
    </div>

    <!-- Content -->
    <div class="container about-section">
        <div class="row mb-5">
            <div class="col-md-6 d-flex align-items-center">
                <img src="./images/about.png" class="img-fluid rounded about-img" alt="About Image">
            </div>
            <div class="col-md-6">
                <h3>Who We Are</h3>
                <p>
                    Welcome to our online shopping store! We are passionate about delivering the best products at the best prices.
                    Our platform brings together top brands and trending products, making your shopping experience smooth, secure, and convenient.
                </p>
                <p>
                    Our mission is to provide a user-friendly platform with quality service, fast delivery, and great customer support.
                </p>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-4">
                <div class="icon-box mb-3"><i class="fas fa-shipping-fast"></i></div>
                <h5>Fast Delivery</h5>
                <p>We deliver your products quickly and safely.</p>
            </div>
            <div class="col-md-4">
                <div class="icon-box mb-3"><i class="fas fa-lock"></i></div>
                <h5>Secure Payments</h5>
                <p>100% safe and encrypted payment options.</p>
            </div>
            <div class="col-md-4">
                <div class="icon-box mb-3"><i class="fas fa-headset"></i></div>
                <h5>24/7 Support</h5>
                <p>We’re here to help you anytime you need us.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>