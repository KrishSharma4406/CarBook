<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:users.view')->only([
    //         'index'
    //     ]);

    //     $this->middleware('permission:users.edit')->only([
    //         'edit',
    //         'update',
    //         'toggleStatus',
    //         'editRole',
    //         'updateRole'
    //     ]);

    //     $this->middleware('permission:users.create')->only([
    //         'create',
    //         'store'
    //     ]);

    //     $this->middleware('permission:users.delete')->only([
    //         'destroy'
    //     ]);
    // }

    public function index()
    {
        $users = User::with('roles')
            ->latest()
            ->paginate(10);

        $totalUsers = User::count();
        $activeUsers = User::where('status', 1)->count();
        $blockedUsers = User::where('status', 0)->count();

        return view('admin.frontend.webview.users', compact(
            'users',
            'totalUsers',
            'activeUsers',
            'blockedUsers'
        ));
    }

    public function edit(User $user)
    {
        return view('admin.frontend.webview.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin-users')
            ->with('success', 'User updated successfully.');
    }

    public function toggleStatus(User $user)
    {
        $user->status = !$user->status;
        $user->save();

        return back()->with('success', 'Status Updated Successfully');
    }

    public function editRole(User $user)
    {
        $user->load('roles');
        $roles = Role::all();

        return view('admin.users.role', compact(
            'user',
            'roles'
        ));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required',
        ]);

        $user->syncRoles($request->role);

        return redirect()
            ->route('admin-users')
            ->with('success', 'Role Updated Successfully.');
    }
}