<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Departments;
use App\Models\JobOpenings;
use App\Models\User;
use Database\Seeders\concerns\ProgressBarConcern;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use ProgressBarConcern;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Permissions
        $this->command->warn(PHP_EOL.'Creating set of permission for roles...');
        $this->withProgressBar(1, function () {
            Artisan::call('permissions:sync -C -Y');

            return [];
        });
        $this->command->info('Sets of permissions has been created.');

        // Roles
        /* Super Administrator Role */
        $this->command->warn(PHP_EOL.'Creating super admin role...');
        $this->withProgressBar(1, function () {
            $role = Role::create(['name' => 'Super Admin']);
            $role->givePermissionTo(Permission::all());

            return [];
        });
        $this->command->info('Super admin role has been created.');

        /* Administrator Role */
        $this->command->warn(PHP_EOL.'Creating admin role...');
        $this->withProgressBar(1, function () {
            $role = Role::create(['name' => 'Administrator']);
            $permissions = Permission::query();
            $excludedPermission = ['impersonate'];
            foreach ($excludedPermission as $value) {
                $permissions = $permissions->where('name', 'not like', '%'.$value);
            }

            $role->givePermissionTo($permissions->get('name')->toArray());

            return [];
        });
        $this->command->info('Admin role has been created.');

        /* Standard Role */
        $this->command->warn(PHP_EOL.'Creating standard role...');
        $this->withProgressBar(1, function () {
            $role = Role::create(['name' => 'Standard']);
            $permissions = Permission::query();
            $excludedPermission = ['delete', 'impersonate', 'restore'];
            foreach ($excludedPermission as $value) {
                $permissions = $permissions->where('name', 'not like', '%'.$value);
            }

            $role->givePermissionTo($permissions->get('name')->toArray());

            return [];
        });
        $this->command->info('Standard role has been created.');

        // Admin
        $this->command->warn(PHP_EOL.'Creating admin user...');
        $user_admin = $this->withProgressBar(1, fn () => User::factory(1)->create([
            'name' => 'Super Admin',
            'email' => 'superuser@mail.com',
            'password' => 'password',
        ]));
        $this->command->info('Admin user created.');

        // Assigning Role to Admin
        $this->command->warn(PHP_EOL.'Assigning super admin role to user...');
        $this->withProgressBar(1, function () use ($user_admin) {
            $user_admin->random(1)
                ->first()->assignRole('Super Admin');

            return [];
        });
        $this->command->info('Super Admin role assigned.');

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
