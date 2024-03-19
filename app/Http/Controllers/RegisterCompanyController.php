<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class RegisterCompanyController extends Controller
{
    public function index()
    {
        return view('register-company');
    }

    public function store(Request $request)
    {

        $request->validate([
            'companyName' => 'required',
            'companyEmail' => 'required|email',
            'companyAddress' => 'required',
            'category' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'confirm_password' => 'same:password',
            'agreement' => 'required|accepted',
        ]);



        $company = new Company();
        $company->name = $request->companyName;
        $company->email = $request->companyEmail;
        $company->address = $request->companyAddress;
        $company->website = $request->companyWebsite;
        $company->save();

        $category = new Categories();
        $category->category = $request->input('category');
        $category->company_id = $company->id;
        $category->save();

        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->company_id = $company->id;
        $admin->save();

        $admin->assignRole('admin');
        event(new Registered($admin));

        if ($admin) {
            Auth::login($admin, true);
            return redirect()->to('/')->with('success', 'Welcome to Taskman!');
        }

        return redirect()->to('/register-company')->with('error', 'Something went wrong. Please try again.');
    }
}
