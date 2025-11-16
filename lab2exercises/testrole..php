<?php
// test_admin.php
$con = mysqli_connect("localhost", "root", "", "rbac_db");
if (!$con) die("Connection failed: " . mysqli_connect_error());

function getUserPermissions($conn, $user_id) {
    $sql = "
        SELECT p.permission_name
        FROM users u
        JOIN roles r ON u.role_id = r.role_id
        JOIN role_permissions rp ON r.role_id = rp.role_id
        JOIN permissions p ON rp.permission_id = p.permission_id
        WHERE u.user_id = ?
    ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $permissions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $permissions[] = $row['permission_name'];
    }
    mysqli_stmt_close($stmt);
    return $permissions;
}

// Test User 1
$user_id = 1;
$perms = getUserPermissions($con, $user_id);

echo "<h2>User 1 Permissions (Should be Admin):</h2>";
foreach ($perms as $p) {
    echo "✅ $p<br>";
}

// Bonus: Admin check
if (in_array('delete_user', $perms)) {
    echo "<hr><button style='background:red;color:white;'>DELETE USER (Admin Only)</button>";
}
?>