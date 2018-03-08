<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ShipmentOrder;
use App\Models\SysCode;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Http\Requests\Admin\Shipment\IndexShipment;
use App\Http\Requests\Admin\Shipment\StoreShipment;
use App\Http\Requests\Admin\Shipment\UpdateShipment;
use App\Http\Requests\Admin\Shipment\DestroyShipment;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Shipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShipmentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexShipment $request
     * @return Response|array
     */
    public function index(IndexShipment $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Shipment::class)->modifyQuery(function($query) use($request){
            $query->where('user_id', Auth::id());
        })->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'ship_date', 'type', 'logistic_company_name', 'tracking_number', 'logistic_status', 'cost_currency', 'cost', 'remarks', 'shipment_status', 'status'],

            // set columns to searchIn
            ['id', 'logistic_company_name', 'tracking_number', 'logistic_status', 'cost_currency', 'remarks']
        );

        $shipmentCodes = SysCode::whereIn('type', ['shipment_type', 'shipment_status'])->where(['status' => SysCode::STATUS_ACTIVE])->get();
        $shipmentTypes = [];
        $shipmentStatus = [];

        if ($shipmentCodes){
            foreach ($shipmentCodes as $code){
                if ($code->type == 'shipment_type'){
                    $shipmentTypes[$code->code] = $code->name;
                } else {
                    $shipmentStatus[$code->code] = $code->name;
                }
            }
        }

        if (!empty($data)){
            foreach($data as &$datum){
                $datum['type_text'] = isset($shipmentTypes[$datum->type]) ? $shipmentTypes[$datum->type] : '-';
                $datum['shipment_status_text'] = isset($shipmentStatus[$datum->shipment_status]) ? $shipmentStatus[$datum->shipment_status] : '-';
            }
        }

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.shipment.index', ['data' => $data, 'shipmentType' => $shipmentTypes, 'shipmentStatus' => $shipmentStatus]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.shipment.create');
        $shipmentCodes = SysCode::whereIn('type', ['shipment_type', 'shipment_status'])->where(['status' => SysCode::STATUS_ACTIVE])->get();
        $overseaOrders = Order::with(['customer' => function($query){
            $query->select(['name', 'wechat_name', 'id']);
        }, 'products.detail.brand'])->select(['id', 'customer_id', 'remarks', 'order_date'])->where(['status' => Order::STATUS_ACTIVE, 'user_id' => Auth::id(), 'order_status' => Order::PENDING_DELIVERY])->get();
        $domeOrders = Order::with(['customer' => function($query){
            $query->select(['name', 'wechat_name', 'id']);
        }, 'products.detail.brand'])->where(['status' => Order::STATUS_ACTIVE, 'user_id' => Auth::id(), 'order_status' => Order::IN_WAREHOUSE])->get();

        $shipmentTypes = [];
        $shipmentStatus = [];

        if ($shipmentCodes){
            foreach ($shipmentCodes as $code){
                if ($code->type == 'shipment_type'){
                    $shipmentTypes[$code->code] = $code->name;
                } else {
                    $shipmentStatus[$code->code] = $code->name;
                }
            }
        }

        return view('admin.shipment.create', ['shipmentType' => $shipmentTypes, 'shipmentStatus' => $shipmentStatus, 'overseaOrders' => $overseaOrders, 'domeOrders' => $domeOrders]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreShipment $request
     * @return Response|array
     */
    public function store(StoreShipment $request)
    {
        // Sanitize input
        $sanitized = $request->validated();
        $sanitized['user_id'] = Auth::id();

        // Store the Shipment
        $shipment = Shipment::create($sanitized);
        $orderStatus = $this->getOrderStatus($shipment->type, $shipment->shipment_status);

        if ($shipment){
            if (isset($sanitized['order_ids']) && !empty($sanitized['order_ids'])){
                foreach ($sanitized['order_ids'] as $orderId){
                    ShipmentOrder::create([
                        'shipment_id' => $shipment->id,
                        'order_id' => $orderId,
                        'status' => ShipmentOrder::STATUS_ACTIVE
                    ]);

                    Order::updateStatus($orderId, $orderStatus);
                }
            }
        }

        if ($request->ajax()) {
            return ['redirect' => url('admin/shipments'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/shipments');
    }

    /**
     * Display the specified resource.
     *
     * @param  Shipment $shipment
     * @return Response
     */
    public function show(Shipment $shipment)
    {
        $this->authorize('admin.shipment.show', $shipment);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Shipment $shipment
     * @return Response
     */
    public function edit(Shipment $shipment)
    {
        $shipment = Shipment::with(['orders.customer', 'orders.products.detail.brand'])->where(['id' => $shipment->id, 'user_id' => Auth::id()])->first();
        $this->authorize('admin.shipment.edit', $shipment);

        $orderIds = [];
        foreach ($shipment->orders as $shipOrder){
            $orderIds[] = $shipOrder->id;
        }

        $shipment['order_ids'] = $orderIds;

        $shipmentCodes = SysCode::whereIn('type', ['shipment_type', 'shipment_status'])->where(['status' => SysCode::STATUS_ACTIVE])->get();
        $overseaOrders = Order::with(['customer' => function($query){
            $query->select(['name', 'wechat_name', 'id']);
        }, 'products.detail.brand'])->select(['id', 'customer_id', 'remarks'])->where(['status' => Order::STATUS_ACTIVE, 'user_id' => Auth::id(), 'order_status' => Order::PENDING_DELIVERY])->get();
        $domeOrders = Order::with(['customer' => function($query){
            $query->select(['name', 'wechat_name', 'id']);
        }, 'products.detail.brand'])->where(['status' => Order::STATUS_ACTIVE, 'user_id' => Auth::id(), 'order_status' => Order::IN_WAREHOUSE])->get();

        $shipmentTypes = [];
        $shipmentStatus = [];

        if ($shipmentCodes){
            foreach ($shipmentCodes as $code){
                if ($code->type == 'shipment_type'){
                    $shipmentTypes[$code->code] = $code->name;
                } else {
                    $shipmentStatus[$code->code] = $code->name;
                }
            }
        }

        return view('admin.shipment.edit', [
            'shipment' => $shipment,
            'shipmentType' => $shipmentTypes,
            'shipmentStatus' => $shipmentStatus,
            'overseaOrders' => $overseaOrders,
            'domeOrders' => $domeOrders
        ]);
    }

    /**
     * Get order status based on shipment status
     * @param $shipmentType
     * @param $shipmentStatus
     * @param $isReverse
     * @return int
     */
    public function getOrderStatus($shipmentType, $shipmentStatus, $isReverse = false){
        $status = 0;
        if ($shipmentType == Shipment::TYPE_INTER){
            if ($isReverse){
                $status = Order::PENDING_DELIVERY;
            } else {
                $status = $shipmentStatus == Shipment::SHIPMENT_SHIPPED ? Order::INTERNATIONAL_SHIPPED : Order::IN_WAREHOUSE;
            }
        } else {
            if ($isReverse){
                $status = Order::IN_WAREHOUSE;
            } else {
                $status = $shipmentStatus == Shipment::SHIPMENT_SHIPPED ? Order::DOMESTIC_SHIPPED : Order::DELIVERED;
            }
        }

        return $status;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateShipment $request
     * @param  Shipment $shipment
     * @return Response|array
     */
    public function update(UpdateShipment $request, Shipment $shipment)
    {
        // Sanitize input
        $sanitized = $request->validated();
        $sanitized['user_id'] = Auth::id();

        DB::beginTransaction();

        // Update changed values Shipment
        $shipment->update($sanitized);
        $orderStatus = $this->getOrderStatus($shipment->type, $shipment->shipment_status);
        $revertOrderStatus = $this->getOrderStatus($shipment->type, $shipment->shipment_status,true);

        if (isset($sanitized['order_ids']) && !empty($sanitized['order_ids'])){

            //delete previous shipment orders
            foreach ($shipment->shipmentorder as $item){
                Order::updateStatus($item->order_id, $revertOrderStatus);
                $item->delete();
            }

            foreach ($sanitized['order_ids'] as $orderId){
                $saveOrder = ShipmentOrder::create([
                    'shipment_id' => $shipment->id,
                    'order_id' => $orderId,
                    'status' => ShipmentOrder::STATUS_ACTIVE
                ]);

                if (!$saveOrder){
                    DB::rollBack();
                }

                Order::updateStatus($orderId, $orderStatus);
            }
        }

        DB::commit();

        if ($request->ajax()) {
            return ['redirect' => url('admin/shipments'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/shipments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyShipment $request
     * @param  Shipment $shipment
     * @return Response|bool
     */
    public function destroy(DestroyShipment $request, Shipment $shipment)
    {
        $shipment->shipmentorder()->delete();
        $shipment->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
