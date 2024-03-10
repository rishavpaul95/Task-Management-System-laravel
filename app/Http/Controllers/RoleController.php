<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $selectedCategory = request('categoryFilter', 'all');

        $roles = Role::all();
        $data = compact('categories', 'selectedCategory', 'roles');
        return view('roles')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles'
        ]);
        $role = Role::create(['name' => $request->name]);
        return redirect('/roles')->with('success', 'Role created successfully');
    }

    public function delete($id)
    {
        $role = Role::findById($id);
        $role->delete();
        return redirect()->back()->with('success', 'Role deleted successfully');
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles'
        ]);
        $role = Role::findById($id);
        $role->name = $request->name;
        $role->save();
        return redirect()->back()->with('success', 'Role updated successfully');
    }

    public function addPermissionToRole($roleId)
    {

        $categories = Categories::all();
        $selectedCategory = request('categoryFilter', 'all');

        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();

        return view('add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory
        ]);
    }

    public function storePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('success', 'Permissions added to role successfully');
    }


}
