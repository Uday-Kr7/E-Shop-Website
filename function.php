<?php
include "config/db.php";
// Get Brands
function getBrands()
{
    global $conn;
    $select_brands = "SELECT * FROM `brands`";
    $select_brands_result = mysqli_query($conn, $select_brands);
    while ($row = mysqli_fetch_assoc($select_brands_result)) {
        $brand_id = $row['brand_id'];
        $brand_name = $row['brand_name'];
        echo "<option value='$brand_id'>$brand_name</option>";
    }
}

// Get Categories
function getCategories()
{
    global $conn;
    $select_categories = "SELECT * FROM `categories`";
    $select_categories_result = mysqli_query($conn, $select_categories);
    while ($row = mysqli_fetch_assoc($select_categories_result)) {
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];
        echo "<option value='$category_id'>$category_name</option>";
    }
}

?>
