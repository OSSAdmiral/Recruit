<?php

namespace Database\Factories;

use App\Models\Candidates;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CandidatesFactory extends Factory
{
    protected $model = Candidates::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'CandidateId' => $this->faker->word(),
            'Email' => $this->faker->unique()->safeEmail(),
            'full_name' => $this->faker->name(),
            'FirstName' => $this->faker->firstName(),
            'LastName' => $this->faker->lastName(),
            'Mobile' => $this->faker->word(),
            'ExperienceInYears' => $this->faker->randomFloat(),
            'CurrentJobTitle' => $this->faker->word(),
            'ExpectedSalary' => $this->faker->word(),
            'SkillSet' => $this->faker->words(),
            'HighestQualificationHeld' => $this->faker->word(),
            'CurrentEmployer' => $this->faker->word(),
            'CurrentSalary' => $this->faker->word(),
            'AdditionalInformation' => $this->faker->word(),
            'Street' => $this->faker->streetName(),
            'City' => $this->faker->city(),
            'Country' => $this->faker->country(),
            'ZipCode' => $this->faker->postcode(),
            'State' => $this->faker->word(),
            'School' => $this->faker->word(),
            'ExperienceDetails' => $this->faker->words(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
