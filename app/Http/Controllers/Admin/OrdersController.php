<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Http\Requests\Admin\Order\IndexOrder;
use App\Http\Requests\Admin\Order\StoreOrder;
use App\Http\Requests\Admin\Order\UpdateOrder;
use App\Http\Requests\Admin\Order\DestroyOrder;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public $currencies = ['RMB', 'SGD'];

    /**
     * Display a listing of the resource.
     *
     * @param  IndexOrder $request
     * @return Response|array
     */
    public function index(IndexOrder $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Order::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'customer_id', 'customer_address_id', 'cost_in_rmb', 'cost_in_sgd', 'revenue_in_rmb', 'revenue_in_sgd', 'profit_in_rmb', 'profit_in_sgd', 'remarks', 'status'],

            // set columns to searchIn
            ['id', 'remarks']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.order.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.order.create');

        $customers = Customer::where(['user_id' => Auth::id(), 'status' => Customer::STATUS_ACTIVE])->select(['id','name'])->get();
        $products = Product::where(['user_id' => Auth::id(), 'status' => Product::STATUS_ACTIVE])->get();

        return view('admin.order.create', ['customers' => $customers, 'currencies' => $this->currencies, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOrder $request
     * @return Response|array
     */
    public function store(StoreOrder $request)
    {
        // Sanitize input
        $sanitized = $request->validated();
        $sanitized['user_id'] = Auth::id();
        $sanitized['status'] = Order::STATUS_ACTIVE;

        //abstract products
        $products = isset($sanitized['products']) && !empty($sanitized['products']) ? $sanitized['products'] : null;

        DB::beginTransaction();

        // Store the Order
        $order = Order::create($sanitized);

        if (!$order){
            DB::rollBack();
        }

        if (!empty($products)){
            foreach ($products as $product){
                $product['order_id'] = $order->id;
                $product['product_id'] = isset($product['detail']['id']) ? $product['detail']['id'] : null;
                $product['status'] = OrderProduct::STATUS_ACTIVE;
                $saveProduct = OrderProduct::create($product);

                if (!$saveProduct){
                    DB::rollBack();
                }
            }
        }

        DB::commit();

        if ($request->ajax()) {
            return ['redirect' => url('admin/orders'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  Order $order
     * @return Response
     */
    public function show(Order $order)
    {
        $this->authorize('admin.order.show', $order);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Order $order
     * @return Response
     */
    public function edit(Order $order)
    {
        $order = Order::with('products.detail')->where(['id' => $order->id])->first();
        $this->authorize('admin.order.edit', $order);

        $addresses = CustomerAddress::where(['customer_id' => $order->customer_id])->get();
        $customers = Customer::where(['user_id' => Auth::id(), 'status' => Customer::STATUS_ACTIVE])->select(['id','name'])->get();
        $products = Product::where(['user_id' => Auth::id(), 'status' => Product::STATUS_ACTIVE])->get();

        return view('admin.order.edit', [
            'order' => $order,
            'customers' => $customers,
            'products' => $products,
            'currencies' => $this->currencies,
            'addresses' => $addresses
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateOrder $request
     * @param  Order $order
     * @return Response|array
     */
    public function update(UpdateOrder $request, Order $order)
    {
        // Sanitize input
        $sanitized = $request->validated();
        $sanitized['status'] = Order::STATUS_ACTIVE;

        //abstract products
        $products = isset($sanitized['products']) && !empty($sanitized['products']) ? $sanitized['products'] : null;

        // Update changed values Order
        $order->update($sanitized);

        if (!empty($products)){
            $previousProducts = $order->products()->delete();
            foreach ($products as $product){
                $product['order_id'] = $order->id;
                $product['product_id'] = isset($product['detail']['id']) ? $product['detail']['id'] : null;
                $product['status'] = OrderProduct::STATUS_ACTIVE;
                $saveProduct = OrderProduct::create($product);

                if (!$saveProduct){
                    DB::rollBack();
                }
            }
        }

        if ($request->ajax()) {
            return ['redirect' => url('admin/orders'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyOrder $request
     * @param  Order $order
     * @return Response|bool
     */
    public function destroy(DestroyOrder $request, Order $order)
    {
        $order->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    public function addProduct(Request $request){
        $index = $request->get('index');

        return view('admin.order.components.order-product', [
            'index' => $index
        ]);
    }
}
