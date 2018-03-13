<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\Http\Requests\Admin\Misc\IndexMisc;
use App\Http\Requests\Admin\Misc\StoreMisc;
use App\Http\Requests\Admin\Misc\UpdateMisc;
use App\Http\Requests\Admin\Misc\DestroyMisc;
use Brackets\AdminListing\Facades\AdminListing;
use App\Models\Misc;
use Illuminate\Support\Facades\Auth;

class MiscsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexMisc $request
     * @return Response|array
     */
    public function index(IndexMisc $request)
    {
        $data = $request->all();
        $data['orderBy'] = !empty($data['orderBy']) ? $data['orderBy'] : 'miscs.updated_at';
        $data['orderDirection'] = !empty($data['orderDirection']) ? $data['orderDirection'] : 'desc';
        $request->merge($data);

        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Misc::class)->modifyQuery(function($query) use($request){
            $query->join('sys_codes', function ($join) {
                    $join->on('miscs.type', '=', 'sys_codes.code')
                        ->where('sys_codes.type', '=', 'misc_type');
                })
                ->where('miscs.user_id', Auth::id())->limit($request->per_page);
        })->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'type', 'date', 'cost_in_rmb', 'cost_in_sgd', 'income_in_rmb', 'income_in_sgd', 'status'],

            // set columns to searchIn
            ['id', 'cost_in_rmb', 'cost_in_sgd', 'income_in_rmb', 'income_in_sgd', 'remarks', 'sys_codes.name']
        );

        $types = Misc::TYPE_LABELS;

        //append type name to misc
        if (!empty($data->items())){
            foreach($data->items() as &$misc){
                $misc->type_name = isset($types[$misc->type]) ? $types[$misc->type] : '-';
                $misc->status_name = $misc->status == Misc::STATUS_ACTIVE ? "Active" : 'Inactive';
            }
        }

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.misc.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.misc.create');
        $types = Misc::TYPE_LABELS;

        return view('admin.misc.create', ['types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreMisc $request
     * @return Response|array
     */
    public function store(StoreMisc $request)
    {
        // Sanitize input
        $sanitized = $request->validated();
        $sanitized['user_id'] = Auth::id();

        // Store the Misc
        $misc = Misc::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/miscs'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/miscs');
    }

    /**
     * Display the specified resource.
     *
     * @param  Misc $misc
     * @return Response
     */
    public function show(Misc $misc)
    {
        $this->authorize('admin.misc.show', $misc);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Misc $misc
     * @return Response
     */
    public function edit(Misc $misc)
    {
        $this->authorize('admin.misc.edit', $misc);
        $types = Misc::TYPE_LABELS;

        return view('admin.misc.edit', [
            'misc' => $misc,
            'types' => $types
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateMisc $request
     * @param  Misc $misc
     * @return Response|array
     */
    public function update(UpdateMisc $request, Misc $misc)
    {
        // Sanitize input
        $sanitized = $request->validated();
        $sanitized['user_id'] = Auth::id();

        // Update changed values Misc
        $misc->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/miscs'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/miscs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DestroyMisc $request
     * @param  Misc $misc
     * @return Response|bool
     */
    public function destroy(DestroyMisc $request, Misc $misc)
    {
        $misc->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }
}
