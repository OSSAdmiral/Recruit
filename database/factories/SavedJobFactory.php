<?php

namespace Database\Factories;

use App\Models\CandidateUser;
use App\Models\SavedJob;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SavedJobFactory extends Factory
{
    protected $model = SavedJob::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'job' => $this->faker->jobTitle(),
            'record_owner' => CandidateUser::all()->random()->first()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
