<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "makeup";
$con = mysqli_connect($server, $user, $pass, $db);

if ($con === false) {
    die("<div class='error'>ERROR: Could not connect. " . mysqli_connect_error() . "</div>");
}
?>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #fff8f8;
        margin: 0;
        padding: 30px;
        text-align: center;
    }

    h2 {
        color: #e91e63;
        margin-bottom: 20px;
    }

    form {
        margin-bottom: 30px;
    }

    input[type="date"] {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
    }

    input[type="submit"] {
        padding: 8px 16px;
        background-color: #2196f3;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        margin-left: 10px;
    }

    table {
        border-collapse: collapse;
        width: 90%;
        margin: auto;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
    }

    tr:hover {
        background-color: #f9f9f9;
    }

    .no-record {
        color: #ff4d4d;
        font-weight: bold;
        margin-top: 20px;
    }

    .success {
        color: green;
        font-weight: bold;
    }
</style>

<h2>Filter Orders by Date</h2>

<form action="" method="post">
    <label for="date">Select a date: </label>
    <input type="date" name="date" required>
    <input type="submit" value="Filter" name="sub">
</form>

<?php
if (isset($_POST['sub'])) {
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $orderquery = "SELECT * FROM `orders` WHERE date='$date'";

    $res = mysqli_query($con, $orderquery);

    if ($res && mysqli_num_rows($res) > 0) {
        echo "<table>
                <tr>
                    <th>User Name</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Date</th>
                </tr>";
        while ($row = mysqli_fetch_array($res)) {
            $u = htmlspecialchars($row['user']);
            $p = htmlspecialchars($row['product']);
            $pr = htmlspecialchars($row['price']);
            $q = htmlspecialchars($row['quantity']);
            $am = htmlspecialchars($row['amount']);
            $d = htmlspecialchars($row['date']);

            echo "<tr>
                    <td>$u</td>
                    <td>$p</td>
                    <td>₹$pr</td>
                    <td>$q</td>
                    <td>₹$am</td>
                    <td>$d</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='no-record'>No orders found for the selected date.</div>";
    }
}
?>
