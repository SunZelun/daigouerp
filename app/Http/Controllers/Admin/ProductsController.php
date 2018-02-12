<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Product::class)->modifyQuery(function($query){
            $query->where('user_id', Auth::id());
        })->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'selling_price_rmb', 'selling_price_sgd', 'buying_price_rmb', 'buying_price_sgd', 'status', 'quantity', 'brand_id', 'category_id'],

            // set columns to searchIn
            ['id', 'description', 'remarks']
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
        $this->authorize('admin.product.show', $product);

        // TODO your code goes here
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
}
