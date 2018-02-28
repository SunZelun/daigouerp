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
        $data = $request->all();
        $data['orderBy'] = !empty($data['orderBy']) ? $data['orderBy'] : 'orders.updated_at';
        $data['orderDirection'] = !empty($data['orderDirection']) ? $data['orderDirection'] : 'desc';
        $request->merge($data);

        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Order::class)->modifyQuery(function($query) use($request){
            $query->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
                ->join('sys_codes', function ($join) {
                    $join->on('orders.order_status', '=', 'sys_codes.code')
                        ->where('sys_codes.type', '=', 'order_status');
                })
                ->where('orders.user_id', Auth::id())->limit($request->per_page);
        })->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'number_of_items_sold', 'order_date', 'customer_id', 'customer_address_id', 'cost_in_rmb', 'cost_in_sgd', 'revenue_in_rmb', 'revenue_in_sgd', 'profit_in_rmb', 'profit_in_sgd', 'remarks', 'status', 'order_status'],

            // set columns to searchIn
            ['id', 'remarks', 'customers.name', 'sys_codes.name']
        );

        $status = Order::ORDER_STATUS_LABELS;
        $rate = session('rate') ? session('rate') : 4.5;

        //append customer name to order
        if (!empty($data->items())){
            foreach($data->items() as &$order){
                $order->customer_name = $order->customer ? $order->customer->name : '-';
                $order->total_cost_in_rmb = round($order->cost_in_rmb + $order->cost_in_sgd * $rate,2);
                $order->total_cost_in_sgd = round($order->cost_in_rmb / $rate + $order->cost_in_sgd,2);
                $order->total_rev_in_rmb = round($order->revenue_in_rmb + $order->revenue_in_sgd * $rate,2);
                $order->total_rev_in_sgd = round($order->revenue_in_rmb / $rate + $order->revenue_in_sgd,2);
                $order->total_profit_in_rmb = round($order->profit_in_rmb + $order->profit_in_sgd * $rate,2);
                $order->total_profit_in_sgd = round($order->profit_in_rmb / $rate + $order->profit_in_sgd,2);
                $order->order_status_name = isset($status[$order->order_status]) ? $status[$order->order_status] : '-';
            }
        }

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

        $customers = Customer::where(['user_id' => Auth::id(), 'status' => Customer::STATUS_ACTIVE])->select(['id','name', 'wechat_name'])->get();
        $products = Product::with('brand')->where(['user_id' => Auth::id(), 'status' => Product::STATUS_ACTIVE])->get();
        $rate = session('rate') ? session('rate') : 4.5;
        $orderStatus = Order::ORDER_STATUS_LABELS;

        return view('admin.order.create', [
            'customers' => $customers,
            'currencies' => $this->currencies,
            'products' => $products,
            'rate' => $rate,
            'orderStatus' => $orderStatus,
        ]);
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

                Product::updateStock($saveProduct->product_id, $saveProduct->quantity);
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
        $order = Order::with(['products.detail', 'customer', 'address'])->where(['id' => $order->id])->first();
        $this->authorize('admin.order.show', $order);
        $order->order_status_name = isset(Order::ORDER_STATUS_LABELS[$order->order_status]) ? Order::ORDER_STATUS_LABELS[$order->order_status] : '-';
        $order->total_profit_in_rmb = round($order->profit_in_rmb + $order->profit_in_sgd * session('rate'),2);
        $order->total_profit_in_sgd = round($order->profit_in_rmb / session('rate') + $order->profit_in_sgd,2);

        return view('admin.order.show', [
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Order $order
     * @return Response
     */
    public function edit(Order $order)
    {
        $order = Order::with(['customer', 'products.detail.brand'])->where(['id' => $order->id])->first();
        $this->authorize('admin.order.edit', $order);

        $addresses = CustomerAddress::where(['customer_id' => $order->customer_id])->get();
        $customers = Customer::where(['user_id' => Auth::id(), 'status' => Customer::STATUS_ACTIVE])->select(['id','name', 'wechat_name'])->get();
        $products = Product::with('brand')->where(['user_id' => Auth::id(), 'status' => Product::STATUS_ACTIVE])->get();
        $rate = session('rate') ? session('rate') : 4.5;
        $orderStatus = Order::ORDER_STATUS_LABELS;

        return view('admin.order.edit', [
            'order' => $order,
            'customers' => $customers,
            'products' => $products,
            'currencies' => $this->currencies,
            'addresses' => $addresses,
            'rate' => $rate,
            'orderStatus' => $orderStatus,
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

        DB::beginTransaction();

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

                Product::updateStock($saveProduct->product_id, $saveProduct->quantity);

            }
        }

        DB::commit();

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
        $order->products()->delete();
        $order->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addProduct(Request $request){
        $index = $request->get('index');

        return view('admin.order.components.order-product', [
            'index' => $index
        ]);
    }

    public function export(Request $request){
        $orderStatus = $request->post('order_status',Order::PENDING_DELIVERY);
        $orders = Order::where(['order_status' => $orderStatus, 'status' => Order::STATUS_ACTIVE])->get()->toArray();

        return $orders;
    }
}
