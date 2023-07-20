<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //
        User::create([
            'name' => Str::random(10),
            'email' => Str::random(10),
            'email_verified_at' => now(),
            'password' =>  Hash::make('password123'), // password
        ]);

    }
}
