<?php

namespace Database\Factories;

use App\Models\JobOpenings;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class JobOpeningsFactory extends Factory
{
    protected $model = JobOpenings::class;

    public function definition(): array
    {
        return [
            'postingTitle' => $this->faker->word(),
            'NumberOfPosition' => $this->faker->word(),
            'JobTitle' => $this->faker->word(),
            'JobOpeningSystemID' => $this->faker->randomDigit(),
            'TargetDate' => Carbon::now()->addMonth(5),
            'Status' => $this->faker->word(),
            'Industry' => $this->faker->words(),
            'Salary' => $this->faker->randomFloat(),
            'Department' => $this->faker->word(),
            'HiringManager' => $this->faker->word(),
            'AssignedRecruiters' => $this->faker->word(),
            'DateOpened' => Carbon::now(),
            'JobType' => $this->faker->word(),
            'RequiredSkill' => $this->faker->word(),
            'WorkExperience' => $this->faker->word(),
            'JobDescription' => $this->faker->text(),
            'City' => $this->faker->city(),
            'Country' => $this->faker->country(),
            'State' => $this->faker->word(),
            'ZipCode' => $this->faker->postcode(),
            'RemoteJob' => $this->faker->boolean(),
            'CreatedBy' => $this->faker->word(),
            'ModifiedBy' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
