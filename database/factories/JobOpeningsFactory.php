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
            'postingTitle' => $this->faker->jobTitle(),
            'NumberOfPosition' => $this->faker->randomDigitNotZero(),
            'JobTitle' => $this->faker->jobTitle(),
            'JobOpeningSystemID' => $this->faker->randomDigitNotZero(),
            'TargetDate' => Carbon::now()->addMonth(5),
            'Industry' => $this->faker->text(255),
            'Salary' => (string)$this->faker->randomDigitNotZero(),
            'DateOpened' => Carbon::now(),
            'JobDescription' => $this->faker->sentences(3, true),
            'City' => $this->faker->city(),
            'Country' => $this->faker->country(),
            'State' => $this->faker->word(),
            'ZipCode' => $this->faker->postcode(),
            'RemoteJob' => $this->faker->boolean(),
            'JobRequirement' => $this->faker->sentences(3, true),
            'JobBenefits' => $this->faker->sentences(3, true),
            'published_career_site' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
