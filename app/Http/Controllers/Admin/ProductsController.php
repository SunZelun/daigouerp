<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipment;
use App\Models\SysCode;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Http\Requests\Admin\Product\IndexProduct;
use App\Http\Requests\Admin\Product\StoreProduct;
use App\Http\Requests\Admin\Product\UpdateProduct;
use App\Http\Requests\Admin\Product\DestroyProduct;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexProduct $request
     * @return Response|array
     */
    public function index(IndexProduct $request)
    {
        $data = $request->all();
        $data['orderBy'] = !empty($data['orderBy']) ? $data['orderBy'] : 'updated_at';
        $data['orderDirection'] = !empty($data['orderDirection']) ? $data['orderDirection'] : 'desc';
        $request->merge($data);
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Product::class)->modifyQuery(function($query){
            $query->where('user_id', Auth::id());
        })->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'selling_price_rmb', 'selling_price_sgd', 'buying_price_rmb', 'buying_price_sgd', 'status', 'quantity', 'brand_id', 'category_id'],

            // set columns to searchIn
            ['id', 'description', 'remarks', 'name']
        );

        //append category and brand name to product
        if (!empty($data->items())){
            foreach($data->items() as &$product){
                $product->brand_name = $product->brand ? $product->brand->name : '-';
                $product->category_name = $product->category ? $product->category->name : '-';
            }
        }

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.product.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.product.create');
        $codes = SysCode::whereIn('type', ['brand', 'category'])->where(['status' => SysCode::STATUS_ACTIVE])->get();
        $categories = [];
        $brands = [];

        //get brands and categories
        if ($codes){
            foreach ($codes as $code){
                if ($code->type == 'brand'){
                    $brands[] = $code;
                } else {
                    $categories[] = $code;
                }
            }
        }

        return view('admin.product.create', ['brands' => $brands, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProduct $request
     * @return Response|array
     */
    public function store(StoreProduct $request)
    {
        // Sanitize input
        $sanitized = $request->validated();
        $sanitized['user_id'] = Auth::id();

        // Store the Product
        $product = Product::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/products'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        $product = Product::with(['category', 'brand'])->where(['id' => $product->id])->first();
        $this->authorize('admin.product.show', $product);
        $priceHistory = $this->priceHistory($product->id);
        $orderStatus = Order::ORDER_STATUS_LABELS;
        $salesRecords = OrderProduct::with(['order.shipments', 'order.customer'])->where(['product_id' => $product->id, 'status' => OrderProduct::STATUS_ACTIVE])->orderBy('created_at',SORT_DESC)->simplePaginate(15);

        return view('admin.product.show', [
            'product' => $product,
            'priceHistory' => $priceHistory,
            'orderStatus' => $orderStatus,
            'salesRecords' => $salesRecords,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $this->authorize('admin.product.edit', $product);
        $product = Product::with(['category', 'brand'])->where(['id' => $product->id])->first();
        $priceHistory = $this->priceHistory($product->id);

        $codes = SysCode::whereIn('type', ['brand', 'category'])->where(['status' => SysCode::STATUS_ACTIVE])->get();
        $categories = [];
        $brands = [];

        //get brands and categories
        if ($codes){
            foreach ($codes as $code){
                if ($code->type == 'brand'){
                    $brands[] = $code;
                } else {
                    $categories[] = $code;
                }
            }
        }

        return view('admin.product.edit', [
            'product' => $product,
            'brands' => $brands,
            'categories' => $categories,
            'priceHistory' => $priceHistory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProduct $request
     * @param  Product $product
     * @return Response|array
     */
    public function update(UpdateProduct $request, Product $product)
    {
        // Sanitize input
        $sanitized = $request->validated();
        $sanitized['user_id'] = Auth::id();

        // Update changed values Product
        $product->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/products'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyProduct $request
     * @param  Product $product
     * @return Response|bool
     */
    public function destroy(DestroyProduct $request, Product $product)
    {
        $product->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    public function search(Request $request){
        $searchTerm = $request->get('q');

        if (empty($searchTerm)){
            return null;
        }

        $products = Product::where('name', 'like', '%'.$searchTerm.'%')
            ->orWhere('description', 'like', '%'.$searchTerm.'%')
            ->where(['status' => Product::STATUS_ACTIVE, 'user_id' => Auth::id()])
            ->get();

        return $products;
    }

    /**
     * Get price history of certain product
     * @param $productId
     * @return array|null
     */
    public function priceHistory($productId){
        if (empty($productId)){
            return null;
        }

        $orderProducts = OrderProduct::with('detail')->where(['status' => OrderProduct::STATUS_ACTIVE, 'product_id' => $productId])->get();

        if (!$orderProducts || empty($orderProducts)){
            return null;
        }

        $priceHistory = [];
        foreach ($orderProducts as $product) {
            $label = $product->selling_currency.$product->selling_price.$product->buying_currency.$product->buying_price;
            $orderDate = !empty($product->detail->order_date) ? $product->detail->order_date : $product->detail->created_at;
            if (!isset($priceHistory[$label])){
                $priceHistory[$label] = [
                    'selling_price' => $product->selling_currency.' '.$product->selling_price,
                    'buying_price' => $product->buying_currency.' '.$product->buying_price,
                    'order_date' => [$orderDate]
                ];
            } else {
                $priceHistory[$label]['order_date'][] = $orderDate;
            }
        }

        return array_values($priceHistory);
    }
}
