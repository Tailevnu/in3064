<?php
$cookieName = "username";
$cookieValue = "Taismile";
$expirationTime = time() + 3600; 
setcookie($cookieName, $cookieValue, $expirationTime);
echo "Cookie named 'username' has been set with the value 'Taismile'.";
?>