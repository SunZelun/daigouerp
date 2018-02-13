<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    protected $fillable = [
        "user_id",
        "name",
        "wechat_name",
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
        return url('/admin/customers/'.$this->getKey());
    }

    /**
     * Get the address for the customer.
     */
    public function addresses()
    {
        return $this->hasMany('App\Models\CustomerAddress','customer_id', 'id');
    }

    /**
     * Get the active address for the customer.
     */
    public function activeAddresses()
    {
        return $this->hasMany('App\Models\CustomerAddress','customer_id', 'id')->where(['status' => CustomerAddress::STATUS_ACTIVE]);
    }
}
