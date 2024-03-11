<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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
    }
}
