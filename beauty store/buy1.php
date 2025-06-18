
<?php
$server = "localhost";
    $user = "root";
    $pass = "";
    $db = "makeup";
    $con = mysqli_connect($server, $user, $pass, $db);
    if ($con === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    } 
    if (isset($_POST['su'])) {
        $qu = (int) $_POST['qu']; 
        $pro=$_POST['pro'];
        if ($qu > 0) { // Validate quantity
            $sql = "SELECT * FROM product WHERE name='$pro'";
            $result = mysqli_query($con, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $pr = $row['price'];
                echo $row['name'];
                $amount = $pr * $qu;
                echo "<h2>Total Amount: ₹" . $amount . "</h2>";
            } else {
                echo "Product not found or error: " . mysqli_error($con);
            }
        } else {
            echo "Please enter a valid quantity.";
        }
    }
    echo"<input type='submit' name='po' value='PLACE ORDER'>";

    mysqli_close($con);
    ?>
