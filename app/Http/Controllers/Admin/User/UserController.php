<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Rerions\RegionModel;
use App\User;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::orderByDesc('id');

        if ( !empty($name = $request->get('name')) ) {
            $query->where('name', 'like' , '%' . $name . '%');
        }

        if ( !empty($email = $request->get('email')) ) {
            $query->where('email', 'like' , '%' . $email . '%');
        }

        if ( !empty($status = $request->get('status')) ) {
            $query->where('status', $status);
        }

        if ( !empty($role = $request->get('role')) ) {
            $query->where('role', $role);
        }

        $users = $query->paginate(15);

        $roles = User::getRoles();

        $statuses = User::getStatuses();

        $data = [
            'users' => $users,
            'roles' => $roles,
            'statuses' => $statuses,
        ];

        return view('admin.tables.users.users_index')->with($data);
    }

    public function create(User $user)
    {
        $roles = User::getRoles();
        $statuses = User::getStatuses();

        $data = [
            'roles' => $roles,
            'statuses' => $statuses
        ];

        return view('admin.tables.users.users_create')->with($data);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|max:255|min:6|confirmed',
            'password_confirmation' => 'required|string|max:255|min:6',
            'status' => ['required','string','max:255', Rule::in(User::getStatuses())],
            'role' => ['required', 'string', 'max:18', Rule::in(User::getRoles())],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'role' => $request->role,
            'email_verified_at' => $request->status === User::STATUS_VERIFY_ACTIVE ? Carbon::now() : null,
        ]);

        return redirect()->route('admin.users.show', $user);
    }

    public function show(User $user)
    {
        return view('admin.tables.users.users_show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        $roles = User::getRoles();
        $statuses = User::getStatuses();

        $data = [
            'user' => $user,
            'roles' => $roles,
            'statuses' => $statuses,
        ];

        return view('admin.tables.users.users_edit')->with($data);
    }


    public function update(Request $request, User $user)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($user->id)],
            'status' => ['required','string', Rule::in(User::getStatuses())],
            'role' => ['required', 'string', 'max:18', Rule::in(User::getRoles())],
        ]);

        $user->update($data);

        return redirect()->route('admin.users.show', $user);
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
