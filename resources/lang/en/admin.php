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
            'user_id' => "User id",
            
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
            'user_id' => "User id",
            'name' => "Name",
            'wechat_name' => "Wechat name",
            'remarks' => "Remarks",
            'status' => "Status",
            
        ],
    ],

    'customer-address' => [
        'title' => 'CustomerAddresses',

        'actions' => [
            'index' => 'CustomerAddresses',
            'create' => 'New CustomerAddress',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'customer_id' => "Customer id",
            'address' => "Address",
            'contact_person' => "Contact person",
            'contact_number' => "Contact number",
            'remarks' => "Remarks",
            'status' => "Status",
            
        ],
    ],

    'product' => [
        'title' => 'Products',

        'actions' => [
            'index' => 'Products',
            'create' => 'New Product',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Name",
            'description' => "Description",
            'selling_price_rmb' => "Selling price rmb",
            'selling_price_sgd' => "Selling price sgd",
            'buying_price_rmb' => "Buying price rmb",
            'buying_price_sgd' => "Buying price sgd",
            'remarks' => "Remarks",
            'status' => "Status",
            
        ],
    ],

    'order' => [
        'title' => 'Orders',

        'actions' => [
            'index' => 'Orders',
            'create' => 'New Order',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'user_id' => "User id",
            'customer_id' => "Customer id",
            'customer_address_id' => "Customer address id",
            'cost_currency' => "Cost currency",
            'total_cost' => "Total cost",
            'amount_currency' => "Amount currency",
            'total_amount' => "Total amount",
            'profit_currency' => "Profit currency",
            'total_profit' => "Total profit",
            'remarks' => "Remarks",
            'status' => "Status",
            
        ],
    ],

    'misc' => [
        'title' => 'Miscs',

        'actions' => [
            'index' => 'Miscs',
            'create' => 'New Misc',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'type' => "Type",
            'date' => "Date",
            'cost_in_rmb' => "Cost in rmb",
            'cost_in_sgd' => "Cost in sgd",
            'income_in_rmb' => "Income in rmb",
            'income_in_sgd' => "Income in sgd",
            'remarks' => "Remarks",
            'status' => "Status",
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];