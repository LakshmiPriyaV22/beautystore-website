<script>
    // Ensure the script runs after the DOM is loaded
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

<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "makeup";
$con = mysqli_connect($server, $user, $pass, $db);
if ($con === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
session_start();
$n=$_SESSION['user'];

$pro = isset($_POST['pro']) ? htmlspecialchars($_POST['pro']) : '';
$qa = isset($_POST['qa']) ? htmlspecialchars($_POST['qa']) : '';
$amount = isset($_POST['amount']) ? htmlspecialchars($_POST['amount']) : '';
echo "<!DOCTYPE html>
<html>
<head>
    <title>Beauty Product Purchase</title>
    <style>
        body {
            background-color: #ffe5f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #d0358e;
            font-size: 2.5em;
            margin-top: 20px;
        }
        form {
            max-width: 400px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #d0358e;
            font-weight: bold;
        }
        input[type='text'], input[type='number'] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #d0358e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        button:hover {
            background-color: #b12976;
        }
    </style>
</head>
<body>
    <h1>Beauty Product Purchase</h1>
    <form action='confirm.php' method='post'>
        <label for='name'>USER NAME</label>
        <input type='text' id='name' name='name' value='$n' readonly>
        
        <label for='address'>ADDRESS</label>
        <input type='text' id='address' name='address' required>
        
        <label for='phone'>PHONE NUMBER</label>
        <input type='number' id='phone' name='phone' required>
         <label for='product'>product</label>
        <input type='text' id='product' name='product' value='$pro' readonly>
        <label for='name'>QUANTITY</label>
        <input type='text' id='quantity' name='quantity' value='$qa' readonly>
        

        <label for='amount'>AMOUNT</label>
        <input type='text' id='amount' name='amount' value='$amount' readonly>
        <label for='payment'>PAYMENT</label>
        <label for='pay'>Choose Payment Type:</label>
<select name='pay' id='pay' required>
    <option value=''>-- Select Payment Type --</option>
    <option value='cod'>Cash on Delivery</option>
    <option value='online'>Online Payment</option>
</select>

<div id='card-details' style='display:none;'>
    <label>Card Number:</label><br>
    <input type='text' name='card' placeholder='XXXX-XXXX-XXXX-XXXX'><br><br>
    <label>Expiry Date:</label><br>
    <input type='month' name='expiry'><br><br>
    <label>CVV:</label><br>
    <input type='text' name='cvv' maxlength='3'><br><br>
</div>

<button type='submit'>PLACE ORDER</button>

 </form>
</body>
</html>";
?>



