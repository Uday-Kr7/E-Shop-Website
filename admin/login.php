<?php
session_start();
include "../config/db.php";

$toast = "";
$toastType = "";

if (isset($_POST['login_btn'])) {
    $email = trim($_POST['username']); // field is "username" (can be email or username)
    $password = $_POST['password'];

    $check_user = "SELECT * FROM `admin_login` WHERE `admin_email`='$email' OR `admin_name`='$email'";
    $result = mysqli_query($conn, $check_user);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hash_password = $row['admin_password'];

        if (password_verify($password, $hash_password)) {
            $_SESSION['admin_name'] = $row['admin_name'];
            $toast = "Login successful! Redirecting...";
            $toastType = "success";

            echo "<script>
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 700);
            </script>";
        } else {
            $toast = "❌ Incorrect password!";
            $toastType = "danger";
        }
    } else {
        $toast = "❌ User not found!";
        $toastType = "danger";
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/logo.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .register-container {
            max-width: 500px;
            margin: 80px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="container register-container">
        <h3 class="text-center mb-4">Admin Login</h3>
        <form method="POST" action="login.php">

            <div class="mb-3">
                <label class="form-label">Username or Email</label>
                <input type="text" class="form-control" name="username" autocomplete="off" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" autocomplete="off" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary" name="login_btn">Login</button>
            </div>

            <div class="text-center mt-3">
                Create an account? <a href="register.php" class="text-decoration-none">Register here</a>
            </div>

        </form>
    </div>

    <!-- Toasts -->
    <?php if (!empty($toast)): ?>
        <div class="position-fixed top-0 end-0 p-3 mt-5" style="z-index: 9999;">
            <div id="liveToast" class="toast text-bg-<?= $toastType ?> border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= $toast ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.getElementById('liveToast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3000,
                    autohide: true
                });
                toast.show();
            }
        });
    </script>
</body>

</html>