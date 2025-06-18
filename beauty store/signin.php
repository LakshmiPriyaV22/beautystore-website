<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="signin.css">
    <title>Beauty Store - Sign In</title>
</head>
<body>
    <div class="container">
        <h1>SIGN IN</h1>
        <form method="post">
            <label for="usern">Username</label><br><br>
            <input type="text" name="usern" id="usern" required><br><br>

            <label for="passn">Password</label><br><br>
            <input type="password" name="passn" id="passn" required><br><br><br>

            <button name="signin" type="submit">Sign In</button>
        </form>
    </div>
</body>
</html>

<?php
session_start();

// DB connection
$con = mysqli_connect("localhost", "root", "", "login");
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// When form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST['usern']);
    $password = trim($_POST['passn']);

    // Fetch hashed password
    $sql = "SELECT password FROM user WHERE username = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashed_password);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);


    if ($hashed_password) {
        // Check password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user'] = $username;

            if ($username === 'admin') {
                $_SESSION['admin'] = true;
                header("Location: admin.php");
                exit();
            } else {
                $_SESSION['admin'] = false;
                header("Location: menu.php");
                exit();
            }
        } else {
            $error = "❌ Password does not match!";
        }
    } else {
        $error = "❌ Username not found!";
    }
}
?>