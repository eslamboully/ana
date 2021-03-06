<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Board;
use App\Models\Package;
use App\Models\PackageTranslation;
use App\Models\SmallBoard;
use App\Models\User;
use App\Models\VerySmallBoard;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $user = User::create([
            'name' => 'Test Account',
            'email' => 'user@user.com',
            'password' => bcrypt('user'),
            'status' => 1
        ]);


        Board::create([
            'name' => 'Personal Board',
            'user_id' => 1,
            'isPersonalities' => 1
        ]);

        SmallBoard::create([
            'title' => 'قائمة المهام',
            'board_id' => 1,
            'bg-color' => 'blue',
            'count_number' => 1
        ]);

        SmallBoard::create([
            'title' => 'قيد التنفيذ',
            'board_id' => 1,
            'bg-color' => 'red',
            'count_number' => 2
        ]);

        SmallBoard::create([
            'title' => 'منتهي',
            'board_id' => 1,
            'bg-color' => 'cyan',
            'count_number' => 3
        ]);

        // Packages
        $package = Package::create([
            'manager_num' => 10,
            'monitor_num' => 20,
            'employee_num' => 30,
            'trial_days' => 7,
            'end_days' => 7,
            'days' => 365,
            'price' => 0,
        ]);
        PackageTranslation::create([
            'title' => 'الباقة البرونزية',
            'locale' => 'ar',
            'package_id' => $package->id
        ]);
        PackageTranslation::create([
            'title' => 'Bronze Package',
            'locale' => 'en',
            'package_id' => $package->id
        ]);

        // Insert Free Package 1 Year
        $package = Package::query()->first();
        DB::table('user_package')->insert([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'start_at' => Carbon::now()->format('d-m-Y'),
            'end_at' => Carbon::now()->addYear()->format('d-m-Y'),
        ]);
    }
}
