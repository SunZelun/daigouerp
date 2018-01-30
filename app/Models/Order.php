<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    
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

    
}
