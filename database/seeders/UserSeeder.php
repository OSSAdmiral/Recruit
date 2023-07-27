<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

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
            'password' =>  Hash::make('superuser')
         ]);

         $AdminAccess = User::create([
            'name' => 'ADMIN',
            'email' => 'admin@mail.com',
            'password' =>  Hash::make('admin')
        ]);
        
        $userAccess = User::create([
            'name' => 'USER',
            'email' => 'user@mail.com',
            'password' =>  Hash::make('user')
        ]);

       /** -- Assign the Pre-defined Role to the User -- **/
        $SuperUserAccess->assignRole('SUPER_USER');
        $AdminAccess->assignRole('ADMIN');
        $userAccess->assignRole('USER');
        
    
    }
}
