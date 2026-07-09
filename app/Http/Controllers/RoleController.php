<?php

namespace App\Http\Controllers;

use App\Actions\Roles\DeleteRoleAction;
use App\Actions\Roles\ListRoleAction;
use App\Actions\Roles\StoreRoleAction;
use App\Actions\Roles\UpdateRoleAction;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request, ListRoleAction $listRoleAction)
    {
        return Inertia::render('Roles/Index', [
            'roles' => $listRoleAction->execute($request),
        ]);
    }

    public function create()
    {
        return Inertia::render('Roles/Create', [
            'permissions' => Permission::all(),
        ]);
    }

    public function store(Request $request, StoreRoleAction $storeRoleAction)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);

        $storeRoleAction->execute($validated);

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        return Inertia::render('Roles/Edit', [
            'role' => $role->load('permissions'),
            'permissions' => Permission::all(),
        ]);
    }

    public function update(Request $request, Role $role, UpdateRoleAction $updateRoleAction)
    {
        $validated = $request->validate([
            'name' => "required|string|unique:roles,name,{$role->id}",
            'permissions' => 'nullable|array',
        ]);

        $updateRoleAction->execute($role, $validated);

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy(Role $role, DeleteRoleAction $deleteRoleAction)
    {
        $deleteRoleAction->execute($role);

        return back()->with('success', 'Role deleted successfully');
    }
}
