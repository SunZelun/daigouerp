<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        "customer_id",
        "address",
        "contact_person",
        "contact_number",
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
        return url('/admin/customer-addresses/'.$this->getKey());
    }

    /**
     * Get the customer detail
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }
}
