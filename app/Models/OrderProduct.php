<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        "order_id",
        "product_id",
        "quantity",
        "selling_currency",
        "selling_price",
        "buying_currency",
        "buying_price",
        "remarks",
        "status",

    ];

    protected $hidden = [

    ];

    protected $dates = [
        "created_at",
        "updated_at",

    ];

}
