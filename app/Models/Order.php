<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
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
     * Get the products for the order.
     */
    public function products()
    {
        return $this->hasMany('App\Models\OrderProduct','order_id', 'id');
    }
    
}
