<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'deleted_at' => null,
        'language' => 'en',
                
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Customer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'wechat_name' => $faker->sentence,
        'remarks' => $faker->sentence,
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Customer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'wechat_name' => $faker->sentence,
        'remarks' => $faker->sentence,
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'user_id' => $faker->randomNumber(5),
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Customer::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomNumber(5),
        'name' => $faker->firstName,
        'wechat_name' => $faker->sentence,
        'remarks' => $faker->sentence,
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\CustomerAddress::class, function (Faker\Generator $faker) {
    return [
        'customer_id' => $faker->randomNumber(5),
        'address' => $faker->sentence,
        'contact_person' => $faker->sentence,
        'contact_number' => $faker->sentence,
        'remarks' => $faker->sentence,
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomNumber(5),
        'description' => $faker->text(),
        'selling_price_rmb' => $faker->randomFloat,
        'selling_price_sgd' => $faker->randomFloat,
        'buying_price_rmb' => $faker->randomFloat,
        'buying_price_sgd' => $faker->randomFloat,
        'remarks' => $faker->text(),
        'status' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Order::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomNumber(5),
        'customer_id' => $faker->randomNumber(5),
        'customer_address_id' => $faker->randomNumber(5),
        'cost_currency' => $faker->sentence,
        'total_cost' => $faker->randomFloat,
        'amount_currency' => $faker->sentence,
        'total_amount' => $faker->randomFloat,
        'profit_currency' => $faker->sentence,
        'total_profit' => $faker->randomFloat,
        'remarks' => $faker->sentence,
        'status' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\SysCode::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->sentence,
        'type' => $faker->sentence,
        'name' => $faker->firstName,
        'status' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Shipment::class, function (Faker\Generator $faker) {
    return [
        'ship_date' => $faker->dateTime,
        'type' => $faker->randomNumber(5),
        'logistic_company_name' => $faker->sentence,
        'tracking_number' => $faker->sentence,
        'logistic_status' => $faker->sentence,
        'cost_currency' => $faker->sentence,
        'cost' => $faker->randomFloat,
        'remarks' => $faker->sentence,
        'shipment_status' => $faker->randomNumber(5),
        'status' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Misc::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->randomNumber(5),
        'date' => $faker->date(),
        'cost_in_rmb' => $faker->sentence,
        'cost_in_sgd' => $faker->sentence,
        'income_in_rmb' => $faker->sentence,
        'income_in_sgd' => $faker->sentence,
        'remarks' => $faker->text(),
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

