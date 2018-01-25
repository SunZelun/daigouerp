<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    
    protected $fillable = [
        "name",
        "description",
        "selling_price_rmb",
        "selling_price_sgd",
        "buying_price_rmb",
        "buying_price_sgd",
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
        return url('/admin/products/'.$this->getKey());
    }

    
}
