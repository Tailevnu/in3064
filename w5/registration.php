<?php
session_start();
header("location:login.php");
/* connect to database check user*/
$con=mysqli_connect('localhost','root','');

mysqli_select_db($con,"LoginReg");

/* create variables to store data */
$name = $_POST['user'];
$pass = $_POST['password'];
$nationality = $_POST['nationality'];
$email = $_POST['email'];

/* select data from DB */
$s = "select * from userReg where name='$name'";

/* result variable to store data */
$result = mysqli_query($con, $s);

/* check for duplicate names and count records */
$num = mysqli_num_rows($result);
if ($num == 1) {
    echo "<script>
            alert('Username already exists! Please choose another one.');
            window.location.href='login.php';
          </script>";
} else {
    /* Thêm người dùng mới */
    $reg = "INSERT INTO userReg (name, password, nationality, email)
            VALUES ('$name', '$pass', '$nationality', '$email')";
    if (mysqli_query($con, $reg)) {
        echo "<script>
                alert('Registration successful! You can now log in.');
                window.location.href='login.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}