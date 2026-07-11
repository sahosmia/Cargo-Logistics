<?php

namespace App\Http\Controllers;

use App\Actions\Roles\DeleteRoleAction;
use App\Actions\Roles\ListRoleAction;
use App\Actions\Roles\StoreRoleAction;
use App\Actions\Roles\UpdateRoleAction;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
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

    public function store(StoreRoleRequest $request, StoreRoleAction $storeRoleAction)
    {
        $validated = $request->validated();

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

    public function update(UpdateRoleRequest $request, Role $role, UpdateRoleAction $updateRoleAction)
    {
        $validated = $request->validated();

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
