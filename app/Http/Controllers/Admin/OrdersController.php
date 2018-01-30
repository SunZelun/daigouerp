<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Http\Requests\Admin\Order\IndexOrder;
use App\Http\Requests\Admin\Order\StoreOrder;
use App\Http\Requests\Admin\Order\UpdateOrder;
use App\Http\Requests\Admin\Order\DestroyOrder;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Order;

class OrdersController extends Controller
{

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
            ['id', 'user_id', 'customer_id', 'customer_address_id', 'cost_currency', 'total_cost', 'amount_currency', 'total_amount', 'profit_currency', 'total_profit', 'remarks', 'status'],

            // set columns to searchIn
            ['id', 'cost_currency', 'amount_currency', 'profit_currency', 'remarks']
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

        return view('admin.order.create');
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

        // Store the Order
        $order = Order::create($sanitized);

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
        $this->authorize('admin.order.edit', $order);

        return view('admin.order.edit', [
            'order' => $order,
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

        // Update changed values Order
        $order->update($sanitized);

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
}
