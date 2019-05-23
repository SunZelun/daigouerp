<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        "name",
        "description",
        "selling_price_rmb",
        "selling_price_sgd",
        "buying_price_rmb",
        "buying_price_sgd",
        "category_id",
        "brand_id",
        "remarks",
        "status",
        "quantity",
        "user_id"
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

    /**
     * Update product stock
     * @param $productId
     * @param $quantity
     * @return mixed
     */
    public static function updateStock($productId, $quantity){
        $product = Product::where(['id' => $productId])->first();
//        $product->quantity = $product->quantity - $quantity;
//        $product->update();

        return $product;
    }

    /**
     * Get product sales
     * @param $productId
     * @return mixed
     */
    public static function productSales($productId){
        $productSales = 0;
        $productSaleRecords = OrderProduct::where([
            ['product_id', '=',$productId],
            ['status', '=', OrderProduct::STATUS_ACTIVE]
        ])->get();

        if (count($productSaleRecords) > 0) {
            foreach ($productSaleRecords as $record) {
                $productSales += $record->quantity;
            }
        }


        return $productSales;
    }

    /**
     * Get the product category
     */
    public function category()
    {
        return $this->belongsTo('App\Models\SysCode','category_id','id');
    }

    /**
     * Get the product brand
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\SysCode','brand_id','id');
    }

    /**
     * Get the order product
     */
    public function orderproducts()
    {
        return $this->hasMany('App\Models\OrderProduct','product_id', 'id')->orderBy('created_at',SORT_DESC);
    }
}
