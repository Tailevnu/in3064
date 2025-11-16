<?php
session_start();

setcookie("username", "cookieuser", time() + 3600, '/');

$_SESSION['username'] = "SessionUser";

echo "Cookie 'username': " . ($_COOKIE['username'] ?? "Not yet set/available on this load");
echo "<br>";
echo "Session 'username': " . ($_SESSION['username']);

?>