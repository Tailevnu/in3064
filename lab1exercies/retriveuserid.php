<?php

session_start();

$session_name = "userid";

echo "<h2>Retrieving Session Variable</h2>";

if (isset($_SESSION[$session_name])) {
    $userid = htmlspecialchars($_SESSION[$session_name]);
    echo "The value of the session variable '{$session_name}' is: $userid<br>";
} else {
    echo "Session variable '{$session_name}' is not set. Please run 'set_userid_session.php' first.";
}
?>