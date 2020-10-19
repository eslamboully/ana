<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Board;
use App\Models\SmallBoard;
use App\Models\User;
use App\Models\VerySmallBoard;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        Admin::create([
            'name' => 'Abdelrahman Osama',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        // Sync Roles
        $permissions = [
            'add-users-to-project','remove-users-to-project',
            'assign-tasks','remove-tasks','modify-tasks'
        ];

        foreach ($permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        // Sync Roles
        $roles = ['Manager','Employee','Monitor'];
        foreach ($roles as $role)
        {
            $role = Role::create(['name' => $role]);

            $role->givePermissionTo(Permission::all());
        }


        // User
        User::create([
            'name' => 'Abdelrahman Osama',
            'email' => 'user@user.com',
            'password' => bcrypt('user'),
            'status' => 1
        ]);

        Board::create([
            'name' => 'my board',
            'user_id' => 1,
            'isPersonalities' => 1
        ]);

        SmallBoard::create([
            'title' => 'Tasks List',
            'board_id' => 1,
            'bg-color' => 'blue',
            'count_number' => 1
        ]);

        SmallBoard::create([
            'title' => 'On Progress',
            'board_id' => 1,
            'bg-color' => 'red',
            'count_number' => 2
        ]);

        SmallBoard::create([
            'title' => 'Completed',
            'board_id' => 1,
            'bg-color' => 'cyan',
            'count_number' => 3
        ]);

        VerySmallBoard::create([
            'small_board_id' => 1,
            'title' => 'fix first bug',
            'border' => 'red',
            'dueDate' => 'MARCH 1, 2019',
        ]);
    }
}
