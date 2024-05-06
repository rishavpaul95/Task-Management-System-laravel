<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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
            'password' => ['nullable', Rules\Password::defaults()],
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

    public function invite(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
        ]);

        $email = strtolower($request->input('email'));
        $company_code = Auth::user()->company->company_code;

        // Generate the registration URL with the email and company_code query strings
        $registrationUrl = URL::to('/register') . '?email=' . urlencode($email) . '&company_code=' . urlencode($company_code);

        // Send the email
        Mail::raw('You have been invited To TaskMan! Register here: ' . $registrationUrl, function ($message) use ($email) {
            $message->to($email)
                ->subject('TaskMan Invitation');
        });

        return redirect('/users/create')->with('status', 'User Invited Successfully');
    }
}
