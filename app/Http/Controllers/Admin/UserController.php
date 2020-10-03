<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $elements = User::all();
        return view('Admin.Users.index',['elements' => $elements]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('Admin.Users.create',['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'role' => 'min:1|required|in:manager,employee,monitor'
        ];
        $data = $request->validate($rules,[],[
            'role' => __('admin.role'),
        ]);

        // New Object
        $data['password'] = bcrypt($request->get('password'));

        $user = User::create($data);

        $user->syncRoles([$data['role']]);

        Session::flash('success', __('admin.success'));

        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $element = User::find($id);
        $roles = Role::all();
        return view('Admin.Users.edit',['element' => $element,'roles' => $roles]);
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'sometimes',
            'role' => 'min:1|required|in:manager,employee,monitor'
        ];
        $data = $request->validate($rules,[],[
            'role' => __('admin.role'),
        ]);

        // New Object
        if ($request->get('password')) {
            $data['password'] = bcrypt($request->get('password'));
        }

        $user = User::find($id);
        $data = array_filter($data);
        $user->update($data);
        $user->syncRoles([$data['role']]);

        Session::flash('success', __('admin.success'));

        return redirect()->route('admin.users.index');

        Session::flash('success', __('admin.success'));
        return redirect()->route('admin.packages.index');
    }

    public function destroy($id)
    {
        $element = User::find($id);
        $element->delete();

        Session::flash('success', __('admin.success'));

        return redirect()->route('admin.users.index');
    }
}
