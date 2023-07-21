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
        
        /* 
        * This will create a dummy user. 
        */
        $faker = Faker::create();
        foreach(range(1,2) as $index)
        {
           $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'email_verified_at' => now(),
                'password' =>  Hash::make('password123'), 
            ]);
            $user->assignRole('admin');
        }
    
    }
}
