<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->middleware('permission:roles.view')->only([
            'index',
            'show',
        ]);

        $this->middleware('permission:roles.create')->only([
            'create',
            'store',
        ]);

        $this->middleware('permission:roles.edit')->only([
            'edit',
            'update',
        ]);

        $this->middleware('permission:roles.delete')->only([
            'destroy',
        ]);
    }

    public function index()
    {
        // dd(Auth::guard('admin')->user());
        // $admin = Auth::guard('admin')->user();

        // dd([
        //     'roles' => $admin->getRoleNames(),
        //     'permissions' => $admin->getAllPermissions()->pluck('name'),
        // ]);

//         dd([
//     'admin' => Auth::guard('admin')->user(),
//     'permissions' => Auth::guard('admin')->user()?->getAllPermissions()->pluck('name'),
//     'roles' => Auth::guard('admin')->user()?->getRoleNames(),
// ]);
        $roles = Role::with('permissions')->latest()->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role Created Successfully');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit', compact(
            'role',
            'permissions'
        ));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'Super Admin') {
            return back()->with('error', 'Super Admin cannot be deleted.');
        }

        $role->delete();

        return back()->with('success', 'Role Deleted Successfully');
    }
}
