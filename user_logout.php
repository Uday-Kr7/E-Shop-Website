<?php
session_start();
if (isset($_SESSION["user_name"])) {
    unset($_SESSION["user_name"]);
}


// Redirect after a short delay using JS and show toast
echo "
<!DOCTYPE html>
<html>
<head>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body>
    <div class='position-fixed top-0 end-0 p-3 mt-5' style='z-index: 9999;'>
        <div class='toast text-bg-success show'>
            <div class='d-flex'>
                <div class='toast-body'>✅ Logged out successfully! Redirecting...</div>
            </div>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js'></script>
    <script>
        setTimeout(function() {
            window.location.href = 'user_login.php';
        }, 300);
    </script>
</body>
</html>
";
