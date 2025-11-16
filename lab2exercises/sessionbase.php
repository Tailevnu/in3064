<?php
session_start();

// Roles and their permissions
$roles = [
    'admin' => ['view_user', 'create_user', 'edit_user', 'delete_user'],
    'user' => ['view_user', 'edit_own_profile'],
    'guest' => ['view_user']
];

// Simulate login (example)
$_SESSION['user_role'] = 'admin'; // Normally set after login verification

// Function to check if logged-in user has required permission
function checkAccess($required_permission) {
    global $roles;

    // If no session role exists → treat as guest
    $user_role = $_SESSION['user_role'] ?? 'guest';

    return in_array($required_permission, $roles[$user_role]);
}
?>
<?php if (checkAccess('delete_user')): ?>
    <button>Delete User</button>
<?php endif; ?>
<?php if (checkAccess('edit_user')): ?>
    <button>Edit User</button>
<?php endif; ?>