<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index($id)
    {
        $elements = Role::findById($id);
        return view('Admin.Permissions.index',['elements' => $elements]);
    }

    public function all_index()
    {
        $elements = Permission::all();
        return view('Admin.Permissions.all_index',['elements' => $elements]);
    }

    public function create()
    {
        return view('admin.Permissions.create');
    }

    public function store(Request $request)
    {
        $data= $request->validate([
            'name' => 'required|unique:roles',
        ]);

        $permission = Permission::create($data);

        Session::flash('success', __('admin.success'));

        return redirect()->route('admin.permissions.all');
    }

    public function create_related($id)
    {
        $role = Role::findById($id);
        $permissions = Permission::all();
        return view('admin.Permissions.related_create',['role' => $role,'permissions' => $permissions]);
    }

    public function store_related(Request $request)
    {
        $role = Role::findById($request->get('role'));
        $permission = Permission::findByName($request->get('permission'));
        $role->givePermissionTo($permission);
        $data = $request->validate([
            'permission' => 'min:1,integer'
        ]);

        Session::flash('success', __('admin.success'));

        return redirect()->route('admin.permissions.index',$request->get('role'));
    }

    public function destroy($name,Request $request)
    {
        $role = Role::findByName($request->get('role'));
        $permission = Permission::findByName($name);
        $role->revokePermissionTo($permission);

        Session::flash('success', __('admin.success'));

        return redirect()->route('admin.permissions.index',$request->get('id'));
    }
}
