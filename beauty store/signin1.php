<html>
    <head>
        <link rel="stylesheet" href="signin.css">
        <title>Beauty Store</title>
    </head>
    <body>
        <div>
            <h1>SIGN IN</h1>
            <form method="post">
                <label for="">UserName</label><br><br>
                <input type="text" name="usern"><br><br>
                <label for="">Password</label><br><br>
                <input type="password" name="passn"><br><br>
                <input type="hidden" name="na" value="usern">
                <input type="hidden" name="pa" value="passn">
                <button name="erumamaadu">Signin</button>
            </form>
        </div>
    </body>
</html>
<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "login";
$con = mysqli_connect($server, $user, $pass, $db);
if ($con === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
function redirect($url) {
    header('Location: ' . $url);
    exit(); 
}
if(isset($_POST['erumamaadu']))
{
    header('Location:admin.php');
}
?>    

