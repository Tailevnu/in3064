<?php
session_start();
$session_name = "preferences";
echo "<h2>Lấy Tùy chọn Phiên người dùng</h2>";
if (isset($_SESSION[$session_name]) && is_array($_SESSION[$session_name])) {
    $preferences = $_SESSION[$session_name];
    echo "<strong>Tùy chọn người dùng:</strong><br>";
    echo "<ul>";
    foreach ($preferences as $key => $value) {
        $display_value = is_bool($value) ? ($value ? "Có" : "Không") : htmlspecialchars($value);
        echo "<li><strong>" . htmlspecialchars($key) . ":</strong> {$display_value}</li>";
    }
    echo "</ul>";
} else {
    echo " '{$session_name}'";
}
?>