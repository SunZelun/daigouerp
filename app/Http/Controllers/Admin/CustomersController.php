<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Http\Requests\Admin\Customer\IndexCustomer;
use App\Http\Requests\Admin\Customer\StoreCustomer;
use App\Http\Requests\Admin\Customer\UpdateCustomer;
use App\Http\Requests\Admin\Customer\DestroyCustomer;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Customer;

class CustomersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexCustomer $request
     * @return Response|array
     */
    public function index(IndexCustomer $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Customer::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'wechat_name', 'remarks', 'status'],

            // set columns to searchIn
            ['id', 'name', 'wechat_name', 'remarks']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.customer.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.customer.create');

        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCustomer $request
     * @return Response|array
     */
    public function store(StoreCustomer $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Customer
        $customer = Customer::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/customers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  Customer $customer
     * @return Response
     */
    public function show(Customer $customer)
    {
        $this->authorize('admin.customer.show', $customer);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Customer $customer
     * @return Response
     */
    public function edit(Customer $customer)
    {
        $this->authorize('admin.customer.edit', $customer);

        return view('admin.customer.edit', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCustomer $request
     * @param  Customer $customer
     * @return Response|array
     */
    public function update(UpdateCustomer $request, Customer $customer)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values Customer
        $customer->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/customers'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyCustomer $request
     * @param  Customer $customer
     * @return Response|bool
     */
    public function destroy(DestroyCustomer $request, Customer $customer)
    {
        $customer->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
