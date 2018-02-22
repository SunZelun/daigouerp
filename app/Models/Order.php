<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const PENDING_DELIVERY = 10;
    const INTERNATIONAL_SHIPPED = 20;
    const IN_WAREHOUSE = 30;
    const DOMESTIC_SHIPPED = 40;
    const DELIVERED = 50;

    const ORDER_STATUS_LABELS = [
        self::PENDING_DELIVERY => '待发货',
        self::INTERNATIONAL_SHIPPED => '国际运输中',
        self::IN_WAREHOUSE => '已入库',
        self::DOMESTIC_SHIPPED => '国内已发货',
        self::DELIVERED => '已送达',
    ];

    protected $fillable = [
        "user_id",
        "customer_id",
        "customer_address_id",
        "cost_in_rmb",
        "cost_in_sgd",
        "revenue_in_rmb",
        "revenue_in_sgd",
        "profit_in_rmb",
        "profit_in_sgd",
        "remarks",
        "status",
        'inter_shipping_currency',
        'inter_shipping_cost',
        'dome_shipping_currency',
        'dome_shipping_cost',
        'number_of_items_sold',
        'order_status',
        'order_date',
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "created_at",
        "updated_at",
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/orders/'.$this->getKey());
    }

    /**
     * Update order status
     * @param $orderId
     * @param $status
     * @return mixed
     */
    public static function updateStatus($orderId, $status){
        $order = Order::where(['id' => $orderId])->first();
        $order->order_status = $status;
        $order->update();

        return $order;
    }

    /**
     * Get the products for the order.
     */
    public function products()
    {
        return $this->hasMany('App\Models\OrderProduct','order_id', 'id');
    }

    /**
     * Get the products for the order.
     */
    public function customer()
    {
        return $this->hasOne('App\Models\Customer','id', 'customer_id');
    }

    /**
     * Get the products for the order.
     */
    public function address()
    {
        return $this->hasOne('App\Models\CustomerAddress','id', 'customer_address_id');
    }

    /**
     * Get orders for the shipment.
     */
    public function shipments()
    {
        return $this->belongsToMany('App\Models\Shipment', 'shipment_orders', 'order_id', 'shipment_id');
    }
}
