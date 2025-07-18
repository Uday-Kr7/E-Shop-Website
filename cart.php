<?php
session_start();
include "./config/db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle Add to Cart
if (isset($_GET['cart_product_id'])) {
    $product_id = (int) $_GET['cart_product_id'];
    $qty = isset($_GET['qty']) ? (int) $_GET['qty'] : 1;

    // Check if product is already in the cart
    $check_query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update quantity
        $update_query = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("iii", $qty, $user_id, $product_id);
        $update_stmt->execute();
    } else {
        // Insert new
        $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("iii", $user_id, $product_id, $qty);
        $insert_stmt->execute();
    }

    header("Location: cart.php");
    exit();
}

// Handle Remove from Cart
if (isset($_GET['remove_product_id'])) {
    $remove_id = (int) $_GET['remove_product_id'];
    $delete_query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("ii", $user_id, $remove_id);
    $stmt->execute();
    header("Location: cart.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Your Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
</head>

<body>
    <div class="main">
        <!-- Navbar -->
        <?php include 'component/navbar.php'; ?>

        <div class="container my-5">
            <h2 class="mb-4">Shopping Cart</h2>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col" class="text-center">Price (₹)</th>
                            <th scope="col" class="text-center">Qty</th>
                            <th scope="col" class="text-end">Subtotal (₹)</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cart_query = "SELECT cart.*, products.product_name, products.product_price, products.product_img1
                               FROM cart
                               JOIN products ON cart.product_id = products.product_id
                               WHERE cart.user_id = ?";
                        $stmt = $conn->prepare($cart_query);
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $grand_total = 0;

                        while ($row = $result->fetch_assoc()) {

                            $product_name = $row['product_name'];
                            $product_price = $row['product_price'];
                            $qty = $row['quantity'];
                            $product_id = $row['product_id'];
                            $image = $row['product_img1'];
                            $subtotal = $qty * $product_price;
                            $grand_total += $subtotal;
                        ?>
                            <tr>
                                <td class="d-flex align-items-center gap-3">
                                    <img src="./product_images/<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($product_name) ?>" class="img-fluid rounded" style="width: 70px;height:70px;object-fit:cover">
                                    <a class="text-decoration-none" href="view_product.php?product_id=<?= $product_id ?>"><?= htmlspecialchars($product_name) ?><br></a>
                                </td>
                                <td class="text-center">₹<?= $product_price ?></td>
                                <td class="text-center"><?= $qty ?></td>
                                <td class="text-end fw-semibold">₹<?= $subtotal ?></td>
                                <td class="text-end">
                                    <a href="?remove_product_id=<?= $product_id ?>" class="btn btn-sm btn-outline-danger">
                                        <i class="fa fa-trash"></i> Remove
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                    <tfoot class="table-light">
                        <tr>
                            <th colspan="3" class="text-end">Grand Total:</th>
                            <th class="text-end fs-5">₹<?= $grand_total ?>/-</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-end gap-3">
                <a href="index.php" class="btn btn-outline-secondary">Continue Shopping</a>
                <a href="payment.php" class="btn btn-success px-4">Proceed to Pay</a>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>