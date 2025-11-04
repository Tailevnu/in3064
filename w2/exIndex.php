<?php
include "connection.php";
?>

<html lang="en">
<head>
    <title>Laptop Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="col-lg-6">
        <h2>Add New Laptop</h2>
        <form action="" name="form1" method="post">
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" name="brand" placeholder="Enter brand">
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" class="form-control" name="model" placeholder="Enter model">
            </div>
            <div class="form-group">
                <label for="processor">Processor:</label>
                <input type="text" class="form-control" name="processor" placeholder="Enter processor">
            </div>
            <div class="form-group">
                <label for="ram">RAM:</label>
                <input type="text" class="form-control" name="ram" placeholder="Enter RAM">
            </div>
            <div class="form-group">
                <label for="storage">Storage:</label>
                <input type="text" class="form-control" name="storage" placeholder="Enter storage">
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" class="form-control" name="price" placeholder="Enter price">
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" name="stock" placeholder="Enter stock">
            </div>
            <button type="submit" name="insert" class="btn btn-primary">Insert</button>
        </form>
    </div>
</div>

<div class="col-lg-12">
    <h2>Laptop Inventory</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Processor</th>
            <th>RAM</th>
            <th>Storage</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($link)) {
            $res = mysqli_query($link, "SELECT * FROM laptops");
            while ($row = mysqli_fetch_array($res)) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["brand"]."</td>";
                echo "<td>".$row["model"]."</td>";
                echo "<td>".$row["processor"]."</td>";
                echo "<td>".$row["ram"]."</td>";
                echo "<td>".$row["storage"]."</td>";
                echo "<td>".$row["price"]."</td>";
                echo "<td>".$row["stock"]."</td>";
                echo "<td><a href='edit.php?id=".$row["id"]."'><button type='button' class='btn btn-success'>Edit</button></a></td>";
                echo "<td><a href='delete.php?id=".$row["id"]."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>
</body>

<?php
// Insert new record
if (isset($_POST["insert"])) {
    mysqli_query($link, "INSERT INTO laptops (brand, model, processor, ram, storage, price, stock) 
        VALUES ('$_POST[brand]', '$_POST[model]', '$_POST[processor]', '$_POST[ram]', '$_POST[storage]', '$_POST[price]', '$_POST[stock]')");
    ?>
    <script type="text/javascript">
        window.location.href = window.location.href;
    </script>
    <?php
}
?>
</html>
