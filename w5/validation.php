<?php
session_start();

$con = mysqli_connect('localhost', 'root', '', 'LoginReg'); // Đã sửa tên DB
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = isset($_POST['user']) ? $_POST['user'] : '';
$pass = isset($_POST['password']) ? $_POST['password'] : '';
$nationality = isset($_POST['nationality']) ? $_POST['nationality'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

$s = "SELECT * FROM userReg WHERE name='$name'";
$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if ($num == 1) {
    echo "Username Exists";
} else {
    $reg = "INSERT INTO userReg (name, password, nationality, email) VALUES ('$name', '$pass', '$nationality', '$email')";
    mysqli_query($con, $reg);
    echo "Registration successful";
    header("Location: login.php");
    exit();
}
?>
