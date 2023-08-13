<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $SuperUserAccess = User::create([
            'name' => 'SUPER USER',
            'email' => 'superuser@mail.com',
            'password' => Hash::make('superuser'),
        ]);

        $AdminAccess = User::create([
            'name' => 'ADMIN',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
        ]);

        $userAccess = User::create([
            'name' => 'USER',
            'email' => 'user@mail.com',
            'password' => Hash::make('user'),
        ]);

        /** -- Assign the Pre-defined Role to the User -- **/
        $SuperUserAccess->assignRole('SUPER_USER');
        $AdminAccess->assignRole('ADMIN');
        $userAccess->assignRole('USER');

    }
}
