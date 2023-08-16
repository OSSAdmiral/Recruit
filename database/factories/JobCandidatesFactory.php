<?php

namespace Database\Factories;

use App\Models\JobCandidates;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class JobCandidatesFactory extends Factory
{
    protected $model = JobCandidates::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
