
<?php
session_start();

/* connect to database check user*/
$con=mysqli_connect('localhost','root',''); 
mysqli_select_db($con,'recipe_share_db');

/* create variables to store data */
$username =$_POST['username'];
$password =$_POST['password'];

$result = mysqli_query($con,"select * from users where username='$username' AND password='$password'");

/* check for duplicate names and count records */
$num =mysqli_num_rows($result);
if($num==1){
    
    // THAY ĐỔI LỚN NHẤT: Lấy TẤT CẢ dữ liệu người dùng từ kết quả truy vấn
    $user_data = mysqli_fetch_array($result); 
    
    /* Storing the username and session */
    $_SESSION['username'] =$user_data['username'];
    // LẤY email và nationality từ MẢNG DỮ LIỆU ĐÃ TRUY VẤN
    
    header('location:home.php');
}else{
    header('location:login.php');
}
?>