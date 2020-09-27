<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysCode extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        "code",
        "type",
        "name",
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
        return url('/admin/sys-codes/'.$this->getKey());
    }

    
}
