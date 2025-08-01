<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $this->authorize('roles.view');
        return inertia('admin/roles/Index', [
            'roles' => Role::with(['permissions'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $this->authorize('roles.create');
        return inertia(
            'admin/roles/Create',
            ['permissions' => Permission::all()]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // dd($request->all());
        $this->authorize('roles.create');
        $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'permissions' => 'required|array'
        ]);
        $role = Role::create([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'guard_name' => 'web',
        ]);
        $role->permissions()->sync($request->permissions);
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role) {
        $this->authorize('roles.view');
        $role->load('permissions');
        return $role;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role) {
        $this->authorize('roles.edit');
        $role->load('permissions');
        return inertia('admin/roles/Update', [
            'role' => $role,
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role) {
        $this->authorize('roles.edit');
        $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'permissions' => 'required|array'
        ]);
        $role->update([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'guard_name' => 'web',
        ]);
        $role->permissions()->sync($request->permissions);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role) {
        $this->authorize('roles.delete');
        $role->delete();
        return redirect()->route('roles.index');
    }
}
