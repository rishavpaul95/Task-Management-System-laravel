<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $categories = Categories::where('company_id', Auth::user()->company_id)->get();
        $selectedCategory = request('categoryFilter', 'all');

        $permissions = Permission::all();
        $data = compact('categories', 'selectedCategory','permissions');
        return view('permissions')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions'
        ]);
        $permission = Permission::create(['name' => $request->name]);
        return redirect()->back()->with('success', 'Permission created successfully');
    }

    public function delete($id)
    {
        $permission = Permission::findById($id);
        $permission->delete();
        return redirect()->back()->with('success', 'Permission deleted successfully');
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions'
        ]);
        $permission = Permission::findById($id);
        $permission->name = $request->name;
        $permission->save();
        return redirect()->back()->with('success', 'Permission updated successfully');
    }


}
