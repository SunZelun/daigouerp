<?php

return [
    'user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => "ID",
            'email' => "Email",
            'password' => "Password",
            'password_repeat' => "Password Confirmation",
            'first_name' => "First name",
            'last_name' => "Last name",
            'activated' => "Activated",
            'forbidden' => "Forbidden",
            'language' => "Language",
                
            //Belongs to many relations
            'roles' => "Roles",
                
        ],
    ],

    'customer' => [
        'title' => 'Customers',

        'actions' => [
            'index' => 'Customers',
            'create' => 'New Customer',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Name",
            'wechat_name' => "Wechat name",
            'remarks' => "Remarks",
            'status' => "Status",
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];