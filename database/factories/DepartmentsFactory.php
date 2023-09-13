<?php

namespace Database\Factories;

use App\Models\departments;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DepartmentsFactory extends Factory
{
    protected $model = departments::class;

    public function definition(): array
    {
        return [
            'DepartmentName' => $this->faker->name(),
            'ParentDepartment' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
