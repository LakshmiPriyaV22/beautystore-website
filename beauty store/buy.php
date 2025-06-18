<!DOCTYPE html>
<html>
<head>
    <title>Beauty Product Purchase</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #f9f9f9, #e0e0f0);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: #ffffff;
            width: 450px;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #6a1b9a;
        }

        h2 {
            font-size: 20px;
            color: #4e148c;
            margin-top: 25px;
            margin-bottom: 10px;
        }

        .product-info {
            margin: 20px 0;
            font-size: 16px;
            color: #333;
        }

        .quantity-control {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .quantity-control button {
            width: 35px;
            height: 35px;
            font-size: 20px;
            background-color: #8e24aa;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .quantity-display {
            font-size: 20px;
            width: 50px;
            text-align: center;
        }

        .order-button {
            width: 100%;
            padding: 14px;
            margin-top: 25px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            background: linear-gradient(to right, #8e24aa, #d05ce3);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.2s, background 0.3s;
        }

        .order-button:hover {
            background: linear-gradient(to right, #6a1b9a, #ba68c8);
            transform: scale(1.03);
        }
    </style>
</head>
<body>
<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "makeup";
$con = mysqli_connect($server, $user, $pass, $db);
if ($con === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$pro = isset($_POST['pro']) ? htmlspecialchars($_POST['pro']) : '';
$n = isset($_POST['n']) ? htmlspecialchars($_POST['n']) : '';

if ($pro) {
    $sql = "SELECT * FROM products WHERE name='$pro'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $pr = $row['price'];
        echo "<div class='card'>";
        echo "<h1>Order Product</h1>";
        echo "<div class='product-info'>";
        echo "<strong>Product:</strong> " . htmlspecialchars($row['name']) . "<br>";
        echo "<strong>Total Price:</strong> ₹<span id='live-price'>" . $pr . "</span>";
        echo "</div>";
        echo "<div class='quantity-control'>";
        echo "<button onclick=\"changeQuantity(-1)\">-</button>";
        echo "<div id='quantity' class='quantity-display'>1</div>";
        echo "<button onclick=\"changeQuantity(1)\">+</button>";
        echo "</div>";
        echo "<form action='bill.php' method='post'>";
        echo "<input type='hidden' name='pro' value='$pro'>";
        echo "<input type='hidden' name='n' value='$n'>";
        echo "<input type='hidden' name='qa' id='qa' value='1'>";
        echo "<input type='hidden' name='amount' id='amount' value='$pr'>";
        echo "<button class='order-button'>ORDER NOW</button>";
        echo "</form>";
        echo "</div>";

        echo "<script>
            let quantity = 1;
            const price = $pr;
            function changeQuantity(delta) {
                quantity = Math.max(1, quantity + delta);
                document.getElementById('quantity').textContent = quantity;
                document.getElementById('qa').value = quantity;
                document.getElementById('amount').value = quantity * price;
                document.getElementById('live-price').textContent = (quantity * price).toFixed(2);
            }
        </script>";
    } else {
        echo "<div class='card'><p>Product not found or error: " . mysqli_error($con) . "</p></div>";
    }
} else {
    echo "<div class='card'><p>Product not specified.</p></div>";
}
mysqli_close($con);
?>
</body>
</html>
