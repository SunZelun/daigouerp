<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class FillPermissionsForSysCode extends Migration
{
    protected $roles;
    protected $permissions;

    public function __construct()
    {
        //New permissions
        $this->permissions = [
            ['name' => 'admin.sys-code',],
            ['name' => 'admin.sys-code.index',],
            ['name' => 'admin.sys-code.create',],
            ['name' => 'admin.sys-code.show',],
            ['name' => 'admin.sys-code.edit',],
            ['name' => 'admin.sys-code.delete',],
        ];

        //Role should already exists
        $this->roles = [
            [
                'name' => 'Administrator',
                'permissions' => [
                    'admin.sys-code',
                    'admin.sys-code.index',
                    'admin.sys-code.create',
                    'admin.sys-code.show',
                    'admin.sys-code.edit',
                    'admin.sys-code.delete',
                ],
            ],
        ];
    }

    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        app()['cache']->forget('spatie.permission.cache');
        DB::transaction(function () {
            foreach ($this->permissions as $permission) {
                $permission = array_merge($permission, [
                    'guard_name' => config('auth.defaults.guard'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
                if(!($permissionItem = DB::table('permissions')->where('name', '=', $permission['name'])->first())) {
                    DB::table('permissions')->insert($permission);
                }
            }

            foreach ($this->roles as $role) {
                $permissions = $role['permissions'];
                unset($role['permissions']);

                if($roleItem = DB::table('roles')->where('name', '=', $role['name'])->first()) {
                    $roleId = $roleItem->id;

                    $permissionItems = DB::table('permissions')->whereIn('name', $permissions)->get();
                    foreach ($permissionItems as $permissionItem) {
                        if(!($rolePermissionItem = DB::table('role_has_permissions')
                            ->where('permission_id', '=', $permissionItem->id)
                            ->where('role_id', '=', $roleId)->first())) {
                            DB::table('role_has_permissions')->insert(['permission_id' => $permissionItem->id, 'role_id' => $roleId]);
                        }
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        app()['cache']->forget('spatie.permission.cache');
        DB::transaction(function () {
            foreach ($this->permissions as $permission) {
                if(!empty($permissionItem = DB::table('permissions')->where('name', '=', $permission['name'])->first())) {
                    DB::table('permissions')->where('id', '=', $permissionItem->id)->delete();
                    DB::table('model_has_permissions')->where('permission_id', '=', $permissionItem->id)->delete();
                }
            }
        });
    }
}
