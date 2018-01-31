<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Http\Requests\Admin\CustomerAddress\IndexCustomerAddress;
use App\Http\Requests\Admin\CustomerAddress\StoreCustomerAddress;
use App\Http\Requests\Admin\CustomerAddress\UpdateCustomerAddress;
use App\Http\Requests\Admin\CustomerAddress\DestroyCustomerAddress;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Auth;

class CustomerAddressesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexCustomerAddress $request
     * @return Response|array
     */
    public function index(IndexCustomerAddress $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(CustomerAddress::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'customer_id', 'address', 'contact_person', 'contact_number', 'remarks', 'status'],

            // set columns to searchIn
            ['id', 'address', 'contact_person', 'contact_number', 'remarks']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.customer-address.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.customer-address.create');

        $customers = Customer::where(['user_id' => Auth::id(), 'status' => Customer::STATUS_ACTIVE])->get();

        return view('admin.customer-address.create', ['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCustomerAddress $request
     * @return Response|array
     */
    public function store(StoreCustomerAddress $request)
    {
        // Sanitize input
        $sanitized = $request->validated();
        $sanitized['customer_id'] = $request->post('customer_id')['id'];

        // Store the CustomerAddress
        $customerAddress = CustomerAddress::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/customer-addresses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/customer-addresses');
    }

    /**
     * Display the specified resource.
     *
     * @param  CustomerAddress $customerAddress
     * @return Response
     */
    public function show(CustomerAddress $customerAddress)
    {
        $this->authorize('admin.customer-address.show', $customerAddress);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CustomerAddress $customerAddress
     * @return Response
     */
    public function edit(CustomerAddress $customerAddress)
    {
        $this->authorize('admin.customer-address.edit', $customerAddress);

        $customers = Customer::where(['user_id' => Auth::id(), 'status' => Customer::STATUS_ACTIVE])->select(['id','name'])->get();

        return view('admin.customer-address.edit', [
            'customerAddress' => $customerAddress,
            'customers' => $customers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCustomerAddress $request
     * @param  CustomerAddress $customerAddress
     * @return Response|array
     */
    public function update(UpdateCustomerAddress $request, CustomerAddress $customerAddress)
    {
        // Sanitize input
        $sanitized = $request->validated();
        $sanitized['customer_id'] = $request->post('customer_id')['id'];

        // Update changed values CustomerAddress
        $customerAddress->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/customer-addresses'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/customer-addresses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyCustomerAddress $request
     * @param  CustomerAddress $customerAddress
     * @return Response|bool
     */
    public function destroy(DestroyCustomerAddress $request, CustomerAddress $customerAddress)
    {
        $customerAddress->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
