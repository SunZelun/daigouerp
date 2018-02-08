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
        $product->quantity = $product->quantity - $quantity;
        $product->update();

        return $product;
    }
}
