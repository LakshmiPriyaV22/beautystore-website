<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <h1>SIGN UP</h1>
        <form method="post">
            <label for="username">Username:</label><br><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="name">Name:</label><br><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="dob">DOB:</label><br><br>
            <input type="date" id="dateofbirth" name="dob" required><br><br>

            <label for="phone">Phone No:</label><br><br>
            <input type="text" id="phonenumber" name="phone" required><br><br>

            <label for="email">Email:</label><br><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="address">Address:</label><br><br>
            <input type="text" id="address" name="address" required><br><br>

            <label for="password">Password:</label><br><br>
            <input type="password" id="password" name="password" required><br><br>

            <label for="confirm-password">Confirm Password:</label><br><br>
            <input type="password" id="confirm-password" name="confirmpassword" required><br><br><br>

            <button class="button" type="submit" name="signup">Sign Up</button>
        </form>
    </div>
</body>
</html>

<?php
// Database connection
$server = "localhost";
$user = "root";
$pass = "";
$db = "login"; // Your database name
$con = mysqli_connect($server, $user, $pass, $db);

if ($con === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['signup'])) {
    $name     = $_POST['name'];
    $username = $_POST['username'];
    $dob      = $_POST['dob'];
    $phone    = $_POST['phone'];
    $email    = $_POST['email'];
    $address  = $_POST['address'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirmpassword'];

    if ($password !== $confirm) {
        echo "<script>alert('Passwords do not match');</script>";
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Generate customer ID (cid)
    $result = mysqli_query($con, "SELECT cid FROM user ORDER BY cid DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);

    if ($row && isset($row['cid'])) {
        $last_number = intval(substr($row['cid'], 4));
    } else {
        $last_number = 0;
    }

    $new_number = $last_number + 1;
    $customer_id = "CUST" . str_pad($new_number, 3, "0", STR_PAD_LEFT);

    // Prepare and bind statement
    $stmt = mysqli_prepare($con, "INSERT INTO user (username, name, dob, phone, email, address, password, cid) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssssss", $username, $name, $dob, $phone, $email, $address, $hashed_password, $customer_id);

    if (mysqli_stmt_execute($stmt)) {
        session_start();
        $_SESSION['user'] = $username;

        // ✅ Redirect to index.php after successful signup
        echo "<script>alert('Sign up successful! Your Customer ID is: $customer_id'); window.location.href = 'index.php';</script>";
        exit();
    } else {
        echo "❌ Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
