<?php
session_start();

echo "<h2>Destroying Session</h2>";
echo "Current Session ID: " . session_id() . "<br><br>";

session_unset();
if (session_destroy()) {
    echo "The session has been successfully destroyed.<br>";
} else {
    echo "Error destroying session.";
}
?>