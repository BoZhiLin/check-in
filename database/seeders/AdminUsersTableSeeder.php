<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\AdminUser;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new AdminUser();
        $admin->name = 'administrator';
        $admin->username = 'admin';
        $admin->password = Hash::make('123456');
        $admin->is_active = true;
        $admin->save();
    }
}
