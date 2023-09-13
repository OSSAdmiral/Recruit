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
            'NumberOfPosition' => $this->faker->randomDigitNotZero(),
            'JobTitle' => $this->faker->word(),
            'JobOpeningSystemID' => $this->faker->randomDigit(),
            'TargetDate' => Carbon::now()->addMonth(5),
            'Industry' => $this->faker->text(255),
            'Salary' => (string)$this->faker->randomDigit(),
            'DateOpened' => Carbon::now(),
            'JobType' => $this->faker->word(),
            'JobDescription' => $this->faker->text(),
            'City' => $this->faker->city(),
            'Country' => $this->faker->country(),
            'State' => $this->faker->word(),
            'ZipCode' => $this->faker->postcode(),
            'RemoteJob' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
