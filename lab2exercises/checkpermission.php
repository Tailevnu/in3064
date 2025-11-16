<?php

$roles = [
    'admin' => ['view_user', 'create_user', 'edit_user', 'delete_user'],
    'user' => ['view_user', 'edit_own_profile'],
    'guest' => ['view_user']
];
$users = [
    1 => ['name' => 'Alice', 'role' => 'admin'],
    2 => ['name' => 'Bob',   'role' => 'user'],
    3 => ['name' => 'Eve',   'role' => 'guest']
];

function hasPermission($user_id, $permission) {
    global $users, $roles;
    $user_role = $users[$user_id]['role'];
    return in_array($permission, $roles[$user_role]);
}
echo hasPermission(1, 'delete_user') ? "User 1 allowed\n" : "User 1 denied\n";
echo hasPermission(2, 'delete_user') ? "User 2 allowed\n" : "User 2 denied\n";
echo hasPermission(3, 'view_user')   ? "User 3 allowed\n" : "User 3 denied\n";
?>
