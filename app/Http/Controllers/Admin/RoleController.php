<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $elements = Role::all();
        return view('Admin.Roles.index',['elements' => $elements]);
    }
}
