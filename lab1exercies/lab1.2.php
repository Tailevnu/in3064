<?php
$cookieName = "Taismile";
if (isset($_COOKIE[$cookieName])) {
    $cookieValue = $_COOKIE[$cookieName];
    echo "Value of cookie 'Taismile': " . $cookieValue;
} else {
    echo "Cookie 'username' not found.";
}
?>