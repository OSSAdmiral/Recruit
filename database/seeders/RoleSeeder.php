<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*-- 
        * Roles For Users 
        *--*/
        Role::create(['name' => 'writer']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        /*-- 
        * Permission For Admin 
        *--*/
        $adminRole = Role::findByName('admin');

        /*-- 
        * Permission For User 
        *--*/
        $userRole = Role::findByName('user');
        /*-- 
        * Permission For Writer 
        *--*/
        $writerRole = Role::findByName('writer');



    }
}
