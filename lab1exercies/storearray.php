<?php
session_start();

$session_name = "preferences";

$userPreferences = [
    "theme" => "light",
    "language" => "Spanish",
    "notifications" => true
];
$_SESSION[$session_name] = $userPreferences;


echo "The array '{$session_name}' has been stored in the session.<br><br>";
echo "<pre>" . print_r($_SESSION[$session_name], true) . "</pre>";
?>