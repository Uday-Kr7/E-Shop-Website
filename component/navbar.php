<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm px-3 bg-body-tertiary">
    <a class="navbar-brand fs-2" href="index.php">E-Shop</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse mx-3" id="navbarContent">
        <!-- Left Nav -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link fs-5" href="about.php">About</a>
            </li>

            <!-- Category Dropdown -->
            <li class="nav-item dropdown mx-2">
                <a class="nav-link dropdown-toggle fs-5" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categories
                </a>
                <?php
                $sql = "SELECT * FROM categories";
                $res = mysqli_query($conn, $sql);
                if (mysqli_num_rows($res) > 0) {
                    echo '<ul class="dropdown-menu" aria-labelledby="categoryDropdown">';
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo '<li><a class="dropdown-item" href="category.php?category_id=' . $row['category_id'] . '">' . $row['category_name'] . '</a></li>';
                    }
                    echo '</ul>';
                }
                ?>
            </li>

            <!-- Brand Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle fs-5" href="#" id="brandDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Brands
                </a>

                <?php
                $sql = "SELECT * FROM brands";
                $res = mysqli_query($conn, $sql);
                if (mysqli_num_rows($res) > 0) {
                    echo '<ul class="dropdown-menu" aria-labelledby="brandDropdown">';
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo '<li><a class="dropdown-item" href="brand.php?brand_id=' . $row['brand_id'] . '">' . $row['brand_name'] . '</a></li>';
                    }
                    echo '</ul>';
                }
                ?>
            </li>

            <!-- Cart -->
            <li class="nav-item">
                <a class="nav-link fs-5" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup class="text-danger fs-7 ms-1"><?php if((isset($_SESSION['user_id']))){
                    $sql = "SELECT * FROM cart WHERE user_id = {$_SESSION['user_id']}";
                    $res = mysqli_query($conn, $sql);
                    echo mysqli_num_rows($res);
                } 
                else echo 0;?></sup></i></a>
            </li>

        </ul>

        <!-- Search and Login -->
        <form class="d-flex me-5 " method="POST" action="search_product.php">
            <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search" name="search_product">
            <button class="btn btn-outline-success" type="submit" name="search">Search</button>
        </form>

        <?php if (isset($_SESSION['user_name'])) {
            echo '<a href="user_logout.php" class="btn btn-outline-primary">Logout</a>';
        } else {
            echo '<a href="user_login.php" class="btn btn-outline-primary">Login</a>';
        } ?>
    </div>
</nav>
<!-- Navbar End -->