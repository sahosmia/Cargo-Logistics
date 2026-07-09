<?php

namespace App\Http\Controllers;

use App\Actions\Users\BulkDeleteUserAction;
use App\Actions\Users\DeleteUserAction;
use App\Actions\Users\GetUsersForSelectAction;
use App\Actions\Users\ListUserAction;
use App\Actions\Users\StoreUserAction;
use App\Actions\Users\UpdateUserAction;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct() {}

    public function index(Request $request, ListUserAction $listUserAction)
    {
        $users = $listUserAction->execute($request);

        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create', [
            'roles' => Role::all(),
        ]);
    }

    public function store(StoreUserRequest $request, StoreUserAction $storeUserAction)
    {
        $storeUserAction->execute($request->validated());

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show(User $user)
    {
        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }

    public function edit(User $user, GetUsersForSelectAction $getUsersForSelectAction)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user->load('roles'),
            'users' => $getUsersForSelectAction->execute(),
            'roles' => Role::all(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user, UpdateUserAction $updateUserAction)
    {
        $updateUserAction->execute($user, $request->validated());

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user, DeleteUserAction $deleteUserAction)
    {
        $deleteUserAction->execute($user);

        return back()->with('success', 'User deleted successfully!');
    }

    public function bulkDestroy(Request $request, BulkDeleteUserAction $bulkDeleteUserAction)
    {
        $bulkDeleteUserAction->execute($request->input('ids', []));

        return back()->with('success', 'Users deleted successfully');
    }
}
