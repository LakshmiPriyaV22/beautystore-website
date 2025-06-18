<?php
session_start();
$server = "localhost";
$user = "root";
$pass = "";
$db = "makeup";
$con = mysqli_connect($server, $user, $pass, $db);
if ($con === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$n = $_SESSION['user'];
$product = $_POST['product'] ?? '';

if (!empty($product)) {
    $product = mysqli_real_escape_string($con, $product); // prevent SQL injection

    $sql = "SELECT * FROM products WHERE name='$product'";
    $res = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_array($res)) {
        $p = $row['name'];
        $pr = $row['price'];
        $img = $row['image'];

        $sql1 = "INSERT INTO cart (user, product, price, pid) VALUES ('$n', '$p', '$pr', '$img')";
        if (mysqli_query($con, $sql1)) {
            echo "✅ Added $p to cart!";
        } else {
            echo "❌ Failed to add to cart: " . mysqli_error($con);
        }
    } else {
        echo "❌ Product '$product' not found in DB";
    }
} else {
    echo "❌ No product received in request";
}
?>
