<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    
    
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

    
}
