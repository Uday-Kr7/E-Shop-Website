<div class="container mt-5">
    <div class="row g-4">
        <?php
        $sql = "SELECT * FROM products order by rand() limit 12";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
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
                            <a href='cart.php?cart_product_id=$product_id' class='btn btn-primary btn-sm px-3 py-2'>Add to Cart</a>
                            <a href='view_product.php?product_id=$product_id' class='btn btn-outline-secondary btn-sm px-3 py-2'>View Item</a>
                        </div>
                    </div>
                </div>
            </div>
            ";
        }
        ?>
    </div>
</div>
