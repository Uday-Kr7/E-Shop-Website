<?php
session_start();
include "./config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['product_id'])) {
    $product_id = (int) $_GET['product_id'];
    $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
}

header("Location: cart.php");
exit();
