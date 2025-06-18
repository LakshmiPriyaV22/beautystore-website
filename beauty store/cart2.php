<?php
session_start();
$n = isset($_SESSION['user']) ? $_SESSION['user'] : '';

$server = "localhost";
$user = "root";
$pass = "";
$db = "makeup";
$con = mysqli_connect($server, $user, $pass, $db);

if ($con === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart and Order Summary</title>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            const paySelect = document.getElementById('pay');
            const cardDetails = document.getElementById('card-details');

            paySelect.addEventListener('change', function () {
                if (this.value === 'online') {
                    cardDetails.style.display = 'block';
                } else {
                    cardDetails.style.display = 'none';
                }
            });
        });
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff0f3;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #d13a58;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #ff7591;
            color: white;
        }

        tr:hover {
            background-color: #fff0f5;
        }

        .d1 {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        input[type="text"] {
            padding: 8px;
            width: 60px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"], button {
            background-color: #d13a58;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 1rem;
            border-radius: 30px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #b72b47;
            transform: scale(1.05);
        }

        form {
            width: 80%;
            margin: auto;
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }

        input[type="radio"] {
            margin-left: 20px;
            margin-right: 5px;
        }

        input[name="add"] {
            padding: 10px;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 10px;
        }

        .summary-container {
            width: 80%;
            margin: auto;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .summary-title {
            text-align: center;
            color: #d13a58;
            font-size: 24px;
            margin-bottom: 25px;
        }

        .summary-item {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .total-amount {
            font-size: 20px;
            color: #b72b47;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .order-form {
            margin-top: 30px;
            text-align: center;
        }

        .order-form input[type="radio"] {
            margin-left: 15px;
            margin-right: 5px;
            accent-color: #d13a58;
        }

        .order-form input[type="text"] {
            padding: 10px;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 10px;
        }

        .order-form button {
            background-color: #d13a58;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 1rem;
            border-radius: 30px;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .order-form button:hover {
            background-color: #b72b47;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<?php
if (isset($_POST['bu'])) {
    $sql = "SELECT * FROM cart WHERE user='$n'";
    if ($res = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($res) > 0) {
            echo "<form method='post'>";
            echo "<table><tr><th>UserName</th><th>Product</th><th>Price</th><th>Image</th><th>Quantity</th></tr>";
            while ($row = mysqli_fetch_array($res)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['user']) . "</td>
                        <td>" . htmlspecialchars($row['product']) . "</td>
                        <td>₹" . htmlspecialchars($row['price']) . "</td>
                        <td><img src='" . htmlspecialchars($row['pid']) . "' class='d1'></td>
                        <td><input type='text' name='quantity[" . $row['pid'] . "]' required></td>
                      </tr>";
            }
            echo "</table>";
            echo "<input type='submit' name='sub' value='Submit'>";
            echo "</form>";
        } else {
            echo "<p style='text-align:center;'>No items in cart.</p>";
        }
    }
}

// Show Order Summary only after quantity submit
if (isset($_POST['sub'])) {
    $quantities = isset($_POST['quantity']) ? $_POST['quantity'] : [];
    $total = 0;

    echo "
    <div class='summary-container'>
        <h2 class='summary-title'>Order Summary</h2>
        <p class='summary-user'>User Name: <strong>$n</strong></p>
    ";

    foreach ($quantities as $productId => $quantity) {
        $ar = (int)$quantity;

        // Update cart
        $updateQuery = "UPDATE cart SET quantity='$ar' WHERE pid='$productId'";
        mysqli_query($con, $updateQuery);

        $sql = "SELECT * FROM cart WHERE pid='$productId'";
        $res = mysqli_query($con, $sql);

        if ($row = mysqli_fetch_array($res)) {
            $price = $row['price'];
            $subtotal = $price * $ar;
            $total += $subtotal;

            echo "
            <div class='summary-item'>
                <img src='$productId' alt='Product Image' class='product-img'>
                <div class='product-details'>
                    <p>Quantity: $ar</p>
                    <p>Subtotal: ₹$subtotal</p>
                </div>
            </div>";
        }
    }

    echo "
        <div class='total-amount'>Total Amount: ₹$total</div>

        <form action='confirm.php' method='post' class='order-form'>
            <label for='pay'>Choose Payment Type:</label>
            <select name='pay' id='pay' required onchange='toggleCardDetails()'>
                <option value=''>-- Select Payment Type --</option>
                <option value='cod'>Cash on Delivery</option>
                <option value='online'>Online Payment</option>
            </select>

            <div id='card-details' class='card-section'>
                <label>Card Number:</label>
                <input type='text' name='card' placeholder='XXXX-XXXX-XXXX-XXXX'>

                <label>Expiry Date:</label>
                <input type='month' name='expiry'>

                <label>CVV:</label>
                <input type='text' name='cvv' maxlength='3'>
            </div>

            <label>Address:</label>
<textarea name='add' rows='4' required class='address-box'></textarea>


            <label>Phone Number:</label>
            <input type='number' name='ph' required>

            <button type='submit' name='gi'>Place Order</button>
        </form>
    </div>";
}
mysqli_close($con);
?>

<script>
function toggleCardDetails() {
    const payment = document.getElementById('pay').value;
    const cardDetails = document.getElementById('card-details');
    cardDetails.style.display = (payment === 'online') ? 'block' : 'none';
}
</script>

<style>
.summary-container {
    max-width: 700px;
    margin: 30px auto;
    background: #fff;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 0 12px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', sans-serif;
}

.summary-title {
    font-size: 24px;
    margin-bottom: 20px;
    color: #d6336c;
    text-align: center;
}
.address-box {
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 2px;
    font-size: 14px;
    resize: vertical;
}


.summary-user {
    margin-bottom: 20px;
    font-weight: bold;
    font-size: 16px;
}

.summary-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    gap: 15px;
    border-bottom: 1px solid #f1f1f1;
    padding-bottom: 10px;
}

.product-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}

.product-details p {
    margin: 2px 0;
}

.total-amount {
    margin: 20px 0;
    font-size: 20px;
    font-weight: bold;
    text-align: right;
    color: #333;
}

.order-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.order-form label {
    font-weight: 500;
}

.order-form input,
.order-form select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    width: 100%;
}

.card-section {
    display: none;
    margin-top: 10px;
}

.order-form button {
    padding: 12px;
    background-color:rgb(147, 24, 69);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

.order-form button:hover {
    background-color: #218838;
}
</style>


</body>
</html>
