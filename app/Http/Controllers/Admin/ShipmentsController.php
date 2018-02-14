<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Http\Requests\Admin\Shipment\IndexShipment;
use App\Http\Requests\Admin\Shipment\StoreShipment;
use App\Http\Requests\Admin\Shipment\UpdateShipment;
use App\Http\Requests\Admin\Shipment\DestroyShipment;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Shipment;

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
        $data = AdminListing::create(Shipment::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'ship_date', 'type', 'logistic_company_name', 'tracking_number', 'logistic_status', 'cost_currency', 'cost', 'remarks', 'shipment_status', 'status'],

            // set columns to searchIn
            ['id', 'logistic_company_name', 'tracking_number', 'logistic_status', 'cost_currency', 'remarks']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.shipment.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.shipment.create');

        return view('admin.shipment.create');
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

        // Store the Shipment
        $shipment = Shipment::create($sanitized);

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
        $this->authorize('admin.shipment.edit', $shipment);

        return view('admin.shipment.edit', [
            'shipment' => $shipment,
        ]);
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

        // Update changed values Shipment
        $shipment->update($sanitized);

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
        $shipment->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
