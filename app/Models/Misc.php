<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Misc extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const TYPE_EXCHANGE_MONEY = 1;
    const TYPE_AD= 2;
    const TYPE_WRAP = 3;
    const TYPE_BENEFITS = 4;
    const TYPE_OTHERS = 5;

    const TYPE_LABELS = [
        self::TYPE_EXCHANGE_MONEY => '换钱',
        self::TYPE_AD => '广告费',
        self::TYPE_WRAP => '包装费',
        self::TYPE_BENEFITS => '员工福利',
        self::TYPE_OTHERS => '其它',
    ];

    protected $fillable = [
        "type",
        "date",
        "cost_in_rmb",
        "cost_in_sgd",
        "income_in_rmb",
        "income_in_sgd",
        "remarks",
        "status",
        "user_id"
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "date",
        "created_at",
        "updated_at",
    
    ];
    
    
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/miscs/'.$this->getKey());
    }

    /**
     * Get the type for the misc.
     */
    public function type()
    {
        return $this->belongsTo('App\Models\SysCode','type','code')->where('type','=', "misc_type");
    }
    
}
