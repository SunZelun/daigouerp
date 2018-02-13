<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Http\Requests\Admin\SysCode\IndexSysCode;
use App\Http\Requests\Admin\SysCode\StoreSysCode;
use App\Http\Requests\Admin\SysCode\UpdateSysCode;
use App\Http\Requests\Admin\SysCode\DestroySysCode;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\SysCode;

class SysCodesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexSysCode $request
     * @return Response|array
     */
    public function index(IndexSysCode $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(SysCode::class)->modifyQuery(function($query){
            $query->whereIn('type', ['category', 'brand']);
        })->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'code', 'type', 'name', 'status'],

            // set columns to searchIn
            ['id', 'code', 'type', 'name']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.sys-code.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.sys-code.create');
        $codes = SysCode::where(['type' => 'type','status' => SysCode::STATUS_ACTIVE])->get();

        return view('admin.sys-code.create', ['codes' => $codes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSysCode $request
     * @return Response|array
     */
    public function store(StoreSysCode $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the SysCode
        $sysCode = SysCode::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/sys-codes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/sys-codes');
    }

    /**
     * Display the specified resource.
     *
     * @param  SysCode $sysCode
     * @return Response
     */
    public function show(SysCode $sysCode)
    {
        $this->authorize('admin.sys-code.show', $sysCode);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  SysCode $sysCode
     * @return Response
     */
    public function edit(SysCode $sysCode)
    {
        $this->authorize('admin.sys-code.edit', $sysCode);

        return view('admin.sys-code.edit', [
            'sysCode' => $sysCode,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSysCode $request
     * @param  SysCode $sysCode
     * @return Response|array
     */
    public function update(UpdateSysCode $request, SysCode $sysCode)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values SysCode
        $sysCode->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/sys-codes'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/sys-codes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroySysCode $request
     * @param  SysCode $sysCode
     * @return Response|bool
     */
    public function destroy(DestroySysCode $request, SysCode $sysCode)
    {
        $sysCode->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
