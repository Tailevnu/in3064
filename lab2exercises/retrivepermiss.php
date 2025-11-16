<?php
// -------------------------------
// 1. Database connection (Global)
// -------------------------------
$con = mysqli_connect("localhost", "root", "", "rbac_db");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// -------------------------------
// 2. Function to get permissions (using prepared statement compatible)
// -------------------------------
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
    if (!$stmt) {
        error_log("Prepare failed: " . mysqli_error($conn));
        return [];
    }

    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    // Sử dụng bind_result để tương thích nếu mysqli_stmt_get_result không có
    mysqli_stmt_bind_result($stmt, $permission_name);

    $permissions = [];
    while (mysqli_stmt_fetch($stmt)) {
        $permissions[] = $permission_name;
    }

    mysqli_stmt_close($stmt);
    return $permissions;
}

// -------------------------------
// 3. Usage
// -------------------------------
$user_id = 1;
$user_permissions = getUserPermissions($con, $user_id);

echo "<h2>Permissions for User ID $user_id:</h2>";
if (empty($user_permissions)) {
    echo "<p>No permissions found or user does not exist.</p>";
} else {
    foreach ($user_permissions as $perm) {
        echo "- $perm<br>";
    }
}

// -------------------------------
// 4. Check Access Function
// -------------------------------
function checkAccess($permissions, $required) {
    return in_array($required, $permissions, true);
}

// -------------------------------
// 5. Display Action Buttons
// -------------------------------
echo "<hr>";
echo "<h3>Action Buttons:</h3>";

if (checkAccess($user_permissions, 'edit_user')) {
    echo "<button style='margin:5px;'>Edit User</button><br>";
}

if (checkAccess($user_permissions, 'delete_user')) {
    echo "<button style='margin:5px; background:red; color:white;'>Delete User</button><br>";
}

if (checkAccess($user_permissions, 'view_user')) {
    echo "<button style='margin:5px;'>View User</button><br>";
} else {
    echo "<em>You don't have permission to view users.</em><br>";
}

mysqli_close($con);
?>
