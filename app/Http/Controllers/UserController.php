<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(

    ) {}

    public function index(Request $request)
    {

     $perPage = $request['per_page'] ?? settings('paginated_quantity', 10);

        $users =  User::query()
            ->when($request['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request['role'] ?? null, function ($query, $role) {
                $query->where('role', $role);
            })
            ->when(isset($request['sort']), function ($query) use ($request) {
                $query->orderBy($request['sort'], $request['direction'] ?? 'desc');
            }, function ($query) {
                $query->latest();
            })
            ->paginate($perPage)
            ->withQueryString($request);
        return Inertia::render('Users/Index', [
            'users' => $users,

        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create', [
            // 'users' => $this->lookupService->getUsersForSelect(),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show(User $user)
    {
        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user,
            'users' => $this->lookupService->getUsersForSelect(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->update($user, $request->validated());

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully!');
    }

    public function bulkDestroy(Request $request)
    {
        $this->userService->bulkDelete($request->input('ids', []));

        return back()->with('success', 'Users deleted successfully');
    }
}
