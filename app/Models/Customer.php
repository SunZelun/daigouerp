<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    
    
    protected $fillable = [
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

    
}
