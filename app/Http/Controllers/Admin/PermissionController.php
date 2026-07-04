<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:admin');
        $this->middleware('permission:permissions.view')->only([
            'index'
        ]);

        $this->middleware('permission:permissions.create')->only([
            'create',
            'store'
        ]);

        $this->middleware('permission:permissions.edit')->only([
            'edit',
            'update'
        ]);

        $this->middleware('permission:permissions.delete')->only([
            'destroy'
        ]);
    }

    public function index()
    {
        $permissions = Permission::latest()->get();

        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'module' => 'required',
            'action' => 'required',
        ]);

        Permission::create([
            'name' => strtolower($request->module) . '.' . strtolower($request->action),
            'guard_name' => 'web'
        ]);

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission Created Successfully');
    }

    public function edit(Permission $permission)
    {
        $parts = explode('.', $permission->name);

        $module = $parts[0] ?? '';
        $action = $parts[1] ?? '';

        return view('admin.permissions.edit', compact(
            'permission',
            'module',
            'action'
        ));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'module' => 'required',
            'action' => 'required',
        ]);

        $permission->update([
            'name' => strtolower($request->module) . '.' . strtolower($request->action),
        ]);

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permission Updated Successfully');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('success', 'Permission Deleted Successfully');
    }
}