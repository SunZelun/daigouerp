<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentOrder extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        "shipment_id",
        "order_id",
        "remarks",
        "status",

    ];

    protected $hidden = [

    ];

    protected $dates = [
        "created_at",
        "updated_at",
    ];

    /**
     * Get the shipment detail
     */
    public function shipment()
    {
        return $this->belongsTo('App\Models\Shipment','shipment_id','id');
    }

    /**
     * Get the order detail
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order','order_id','id');
    }
}
