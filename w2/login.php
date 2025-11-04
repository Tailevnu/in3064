<?php
session_start();
include("db_connect.php");

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($link, $query);

    if(mysqli_num_rows($result) == 1){
        echo "Login successful!";
    } else {
        echo "Invalid username or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Basic HTML Form</title>
</head>
<body>
  <h2>Login Form</h2>
  <form action="login.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" name="username"><br>

    <label for="password">Password:</label><br>
    <input type="password" name="password"><br><br>
    <input type="submit" name="login" value="Login">
  
  </form>
</body>
</html>
