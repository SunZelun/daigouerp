<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const TYPE_INTER = 1;
    const TYPE_DOME = 2;
    const TYPE_LABELS = [
        self::TYPE_INTER => "国际运输",
        self::TYPE_DOME => "国内运输"
    ];

    const SHIPMENT_SHIPPED = 10;
    const SHIPMENT_DELIVERED = 20;

    const SHIPMENT_STATUS_LABELS = [
        self::SHIPMENT_SHIPPED => "已发货",
        self::SHIPMENT_DELIVERED => "已送达"
    ];

    const SHIPMENT_STATUS_COLORS = [
        self::SHIPMENT_SHIPPED => 'badge-warning',
        self::SHIPMENT_DELIVERED => 'badge-success'
    ];

    protected $fillable = [
        "ship_date",
        "type",
        "logistic_company_name",
        "tracking_number",
        "logistic_status",
        "cost_currency",
        "cost",
        "remarks",
        "shipment_status",
        "status",
        "user_id",
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "ship_date",
        "created_at",
        "updated_at",
    
    ];
    
    
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/shipments/'.$this->getKey());
    }

    /**
     * Get orders for the shipment.
     */
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order', 'shipment_orders', 'shipment_id', 'order_id');
    }

    /**
     * Get ship orders.
     */
    public function shipmentorder()
    {
        return $this->hasMany('App\Models\ShipmentOrder','shipment_id', 'id');
    }
}
