<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Departments;
use App\Models\JobOpenings;
use App\Models\User;
use Database\Seeders\concerns\ProgressBarConcern;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use ProgressBarConcern;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Permissions
        /*$this->command->warn(PHP_EOL . 'Creating set of permission for roles...');
        $arrayOfPermissionNames = ['Add Role', 'Delete Role', 'Add User', 'Delete User', 'View User', 'View Role', 'View Profile', 'View Permissions'];
        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });
        $this->withProgressBar(1, fn () => Permission::create($permissions->toArray()));
        $this->command->info('Sets of permissions has been created.');

        // Roles
        $this->command->warn(PHP_EOL . 'Creating super admin role...');
        $this->withProgressBar(1, fn () => Role::create(['name' => 'SUPER_USER'])->givePermissionTo(Permission::all()));
        $this->command->info('Super admin role has been created.');*/

        // Admin
        $this->command->warn(PHP_EOL.'Creating admin user...');
        $user_admin = $this->withProgressBar(1, fn () => User::factory(1)->create([
            'name' => 'Super Admin',
            'email' => 'superuser@mail.com',
        ]));
        $this->command->info('Admin user created.');

        // Assigning Role to Admin
        /*$this->command->warn(PHP_EOL . 'Assigning admin role to user...');
        $this->withProgressBar(1, fn() => $user_admin->first()->assignRole('SUPER_USER'));
        $this->command->info('Admin role assigned.');*/

        // Departments
        $this->command->warn(PHP_EOL.'Creating Departments...');
        $departments = $this->withProgressBar(5, fn () => Departments::factory(1)->create([
            'ParentDepartment' => null,
        ]));
        $this->command->info('Departments created.');

        // Job Openings
        $this->command->warn(PHP_EOL.'Creating Job Openings...');
        $this->withProgressBar(15, fn () => JobOpenings::factory(1)->create([
            'Department' => $departments->random(rand(1, 5))->first()->id,
            'JobType' => 'Permanent',
            'RequiredSkill' => 'Management',
            'WorkExperience' => '0_1year',
            'HiringManager' => $user_admin->random(1)->first()->id,
            'ModifiedBy' => $user_admin->random(1)->first()->id,
            'CreatedBy' => $user_admin->random(1)->first()->id,
            'Status' => 'Opened',
        ]));
        $this->command->info('Job Openings created.');

    }
}
