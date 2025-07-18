<?php
include "../config/db.php";

$toast = ""; // success or error message
$toastType = ""; // success / danger

if (isset($_POST['register_btn'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $toast = "All fields are required.";
        $toastType = "danger";
    } elseif ($password !== $confirm_password) {
        $toast = "Password and Confirm Password must match.";
        $toastType = "danger";
    } else {
        $check_user = "SELECT * FROM `admin_login` WHERE `admin_email`='$email' OR `admin_name`='$username'";
        $result = mysqli_query($conn, $check_user);

        if (mysqli_num_rows($result) > 0) {
            $toast = "Username or email already exists.";
            $toastType = "danger";
        } else {
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $insert = "INSERT INTO `admin_login`(`admin_name`, `admin_email`, `admin_password`) 
                       VALUES ('$username','$email','$hash_password')";
            if (mysqli_query($conn, $insert)) {
                $toast = "Registration successful! Redirecting to login...";
                $toastType = "success";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 1000);
                </script>";
            } else {
                $toast = "Something went wrong. Try again.";
                $toastType = "danger";
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../images/logo.jpg">
    <!-- Bootstrap CSS -->
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
        <h3 class="text-center mb-4">Create an Account</h3>
        <form method="POST" action="register.php">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" autocomplete="off" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" autocomplete="off" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" autocomplete="off" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" autocomplete="off" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary" name="register_btn">Register</button>
            </div>

            <div class="text-center mt-3">
                Already have an account? <a href="login.php" class="text-decoration-none">Login here</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap Toast Container -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.getElementById('liveToast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 2000,
                    autohide: true
                });
                toast.show();
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    

</body>

</html>