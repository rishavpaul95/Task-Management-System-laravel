<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {
        $categories = Categories::where('company_id', Auth::user()->company_id)->get();
        $selectedCategory = request('categoryFilter', 'all');

        $company = Company::find(Auth::user()->company_id);

        $data = compact('categories', 'selectedCategory', 'company');
        return view("company")->with($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'companyName' => 'required',
            'companyEmail' => 'required|email',
            'companyWebsite' => 'nullable',
            'companyAddress' => 'required',
        ]);

        $company = Company::find(Auth::user()->company_id);
        $company->name = $request->companyName;
        $company->email = $request->companyEmail;
        $company->website = $request->companyWebsite;
        $company->address = $request->companyAddress;
        $company->save();

        return redirect()->to('/company_profile')->with('success', 'Company Details updated successfully');
    }
}
