<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
    public function index()
    {
        $categories = Categories::where('company_id', Auth::user()->company_id)->get();
        $selectedCategory = request('categoryFilter', 'all');
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'super-admin');
        })
            ->where('company_id', '=', Auth::user()->company_id)
            ->get();
        $roles = Role::pluck('name', 'name')->all();
        $data = compact('categories', 'selectedCategory', 'users', 'roles');
        return view('users')->with($data);
    }


    public function create()
    {
        $categories = Categories::where('company_id', Auth::user()->company_id)->get();
        $selectedCategory = request('categoryFilter', 'all');
        $roles = Role::where('name', '!=', 'super-admin')->pluck('name', 'name')->all();
        return view('createuser', [
            'roles' => $roles,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'confirm_password' => 'same:password',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_id' =>  Auth::user()->company_id,
        ]);

        $user->syncRoles($request->roles);
        event(new Registered($user));
        return redirect('/users')->with('status', 'User created successfully with roles');
    }

    public function edit(User $user)
    {

        $categories = Categories::where('company_id', Auth::user()->company_id)->get();
        $selectedCategory = request('categoryFilter', 'all');
        $roles = Role::where('name', '!=', 'super-admin')->pluck('name', 'name')->all();

        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('edituser', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => ['required', Rules\Password::defaults()],
            'roles' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status', 'User Updated Successfully with roles');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('status', 'User Delete Successfully');
    }
}
