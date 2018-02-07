<?php namespace App\Models;

use App\Http\Observers\OrderProductUpdateObserver;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public static function boot() {

        parent::boot();

        parent::observe(new OrderProductUpdateObserver());
    }
    
    protected $fillable = [
        "user_id",
        "customer_id",
        "customer_address_id",
        "cost_currency",
        "total_cost",
        "amount_currency",
        "total_amount",
        "profit_currency",
        "total_profit",
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
