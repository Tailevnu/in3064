<?php
include "connection.php";

$id = $_GET["id"];
mysqli_query($link, "DELETE FROM laptops WHERE id=$id");

// chuyển về index.php sau khi xóa
header("Location: exIndex.php");
exit;
?>

<script type="text/javascript">
    window.location = "index.php";
</script>
