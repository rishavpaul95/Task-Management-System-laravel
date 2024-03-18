<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'add_own_task',
            'assign_task',
            'comment_all_task_delete',
            'comment_others_task',
            'comment_own_delete',
            'comment_own_task',
            'delete_assigned_task',
            'delete_others_task',
            'delete_own_assigned_task',
            'delete_own_task',
            'edit_assigned_task',
            'edit_others_task',
            'edit_own_assigned_task',
            'edit_own_task',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        //assigning permissions to super-admin
        $role = Role::findByName('super-admin');
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        //assigning permissions to admin
        $role = Role::findByName('admin');
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }


        //assigning permissions to manager
        $role = Role::findByName('manager');
        $permissions = Permission::whereNotIn('name', [
            'delete_others_task',
            'edit_own_assigned_task',
            'delete_own_assigned_task',
            'comment_all_task_delete'
        ])->get();
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        //assigning permissions to teamlead
        $role = Role::findByName('teamlead');
        $permissions = Permission::whereIn('name', [
            'assign_task',
            'edit_own_task',
            'delete_own_task',
            'add_own_task',
            'comment_own_task',
            'comment_own_delete'
        ])->get();
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }

        //assigning permissions to employee
        $role = Role::findByName('employee');
        $permissions = Permission::whereIn('name', [
            'comment_own_task',
            'comment_own_delete'
        ])->get();
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }
    }
}
