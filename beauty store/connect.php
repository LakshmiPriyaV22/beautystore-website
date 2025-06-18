<?php
$user=$_POST['username']
$email=$_POST['email']
$pass=$_POST['password']
$cpass=$_POST['confirmpassword']
if ($password !== $confirm_password) {
    echo "Passwords do not match!";
    exit();
}
?>