<?php

$roles = [
    'admin' => [
        'view_user',
        'create_user',
        'edit_user',
        'delete_user'
    ],

    'user' => [
        'view_user',
        'edit_own_profile'
    ],

    'guest' => [
        'view_user'
    ]
];

// Example: check permissions
function hasPermission($role, $permission, $roles) {
    return in_array($permission, $roles[$role]);
}

// Test
echo hasPermission('admin', 'delete_user', $roles) ? "Allowed" : "Denied";