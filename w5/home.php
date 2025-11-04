<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

// Kết nối database
$con = mysqli_connect('localhost', 'root', '', 'LoginReg');
$username = $_SESSION['username'];
$query = "SELECT nationality, email FROM userReg WHERE name='$username'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);
?>

<html lang='en'>
<head>
    <title>Home page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>
<body>
<div class="container">

    <a class="float-right" href="logout.php">LOGOUT</a>
    <h1>Welcome <?php echo $_SESSION['username']; ?> </h1>
    <p>Nationality: <?php echo $user['nationality']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>
  

</div>



</body>