<style>
    body {
        background-image: url("admin.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        text-align: center;
        color: #333;
    }

    h1 {
        margin-top: 30px;
        color: #e91e63;
        font-size: 2.5em;
    }

    form {
        margin-top: 20px;
    }

    .btn {
        margin: 10px;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-insert {
        background-color: #ec7cc3;
        color: white;
    }

    .btn-restock {
        background-color: #9563ac;
        color: white;
    }

    .btn-delete {
        background-color: #cab141;
        color: white;
    }

    .btn-order {
        background-color: #69a8f6;
        color: white;
    }

    .btn-submit {
        margin-top: 15px;
        padding: 10px 18px;
        background-color: #3f51b5;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-container {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 30px;
        margin: 30px auto;
        width: 400px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-top: 12px;
        font-weight: bold;
        text-align: left;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .success {
        color: green;
        font-weight: bold;
    }

    .error {
        color: red;
        font-weight: bold;
    }
</style>

<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "makeup";
$con = mysqli_connect($server, $user, $pass, $db);

if (!$con) {
    die("<div class='error'>ERROR: Could not connect. " . mysqli_connect_error() . "</div>");
}

echo "
    <form method='POST'>
        <h1>ADMIN PANEL</h1>
        <input type='submit' name='insert' value='INSERT' class='btn btn-insert'>
        <input type='submit' name='restock' value='RESTOCK' class='btn btn-restock'>
        <input type='submit' name='delete' value='DELETE' class='btn btn-delete'>
    </form>
    <form action='orderlist.php' method='post'>
        <input type='submit' name='order' value='ORDER LIST' class='btn btn-order'>
    </form>";

if (isset($_POST['insert'])) {
    echo "
    <form method='POST'>
        <div class='form-container'>
            <h2>Insert Product</h2>
            <label>Product Name:</label>
            <input type='text' name='pname' required>
            
            <label>Product Price:</label>
            <input type='number' step='0.01' name='price' required>
            
            <label>Product Quantity:</label>
            <input type='number' name='quantity' required>
            
            <label>Product ID:</label>
            <input type='text' name='pid' required>
            
            <label>Image URL:</label>
            <input type='text' name='image' required>
            
            <input type='submit' name='submitInsert' value='INSERT PRODUCT' class='btn-submit'>
        </div>
    </form>";
}

if (isset($_POST['submitInsert'])) {
    $pname = mysqli_real_escape_string($con, $_POST['pname']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $pid = mysqli_real_escape_string($con, $_POST['pid']);
    $image = mysqli_real_escape_string($con, $_POST['image']);

    $sql = "INSERT INTO products (name, price, quantity, id, image) VALUES ('$pname', '$price', '$quantity', '$pid', '$image')";
    if (mysqli_query($con, $sql)) {
        echo "<div class='success'>✔ Product inserted successfully</div>";
    } else {
        echo "<div class='error'>✖ Product insertion failed: " . mysqli_error($con) . "</div>";
    }
}

if (isset($_POST['restock'])) {
    echo "
    <form method='POST'>
        <div class='form-container'>
            <h2>Restock Product</h2>
            <label>Product Name:</label>
            <input type='text' name='pname' required>
            
            <label>Quantity to Restock:</label>
            <input type='number' name='quantity' required>
            
            <input type='submit' name='submitRestock' value='RESTOCK PRODUCT' class='btn-submit'>
        </div>
    </form>";
}

if (isset($_POST['submitRestock'])) {
    $pname = mysqli_real_escape_string($con, $_POST['pname']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $sql = "SELECT quantity FROM products WHERE name='$pname'";
    $res = mysqli_query($con, $sql);
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $newQuantity = $row['quantity'] + $quantity;
        $updateSql = "UPDATE products SET quantity='$newQuantity' WHERE name='$pname'";
        if (mysqli_query($con, $updateSql)) {
            echo "<div class='success'>✔ Product restocked successfully</div>";
        } else {
            echo "<div class='error'>✖ Product restocking failed: " . mysqli_error($con) . "</div>";
        }
    } else {
        echo "<div class='error'>✖ Product not found. Please check the name.</div>";
    }
}

if (isset($_POST['delete'])) {
    echo "
    <form method='POST'>
        <div class='form-container'>
            <h2>Delete Product</h2>
            <label>Product Name:</label>
            <input type='text' name='pname' required>
            
            <input type='submit' name='submitDelete' value='DELETE PRODUCT' class='btn-submit' style='background-color:#dc3545;'>
        </div>
    </form>";
}

if (isset($_POST['submitDelete'])) {
    $pname = mysqli_real_escape_string($con, $_POST['pname']);
    $sql = "DELETE FROM products WHERE name='$pname'";
    if (mysqli_query($con, $sql)) {
        echo "<div class='success'>✔ Product deleted successfully</div>";
    } else {
        echo "<div class='error'>✖ Product deletion failed: " . mysqli_error($con) . "</div>";
    }
}

mysqli_close($con);
?>
