
<?php
session_start();
// header("location:login.php");
/* connect to database check user*/
$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,"recipe_share_db");

/* create variables to store data */
$username =$_POST['username'];
$password =$_POST['password'];
$email =$_POST['email'];
$phone =$_POST['phone'];


/* result variable to store data */
$result = mysqli_query($con,"select * from users where username='$username'");

/* check for duplicate names and count records */
$num =mysqli_num_rows($result);
if($num==1){
    echo "Username Exists";
}else{
    $reg ="insert into users(username,password,email,phone) values ('$username','$password','$email','$phone')";
    mysqli_query($con,$reg);
    echo "registration successful";
}
