<?php
session_start();

$session_name = "userid";
$session_value = 1345;

$_SESSION[$session_name] = $session_value;

echo "<h2>Setting Session Variable</h2>";
echo "Session '{$session_name}' is set to: <strong>{$session_value}</strong><br>";
?>