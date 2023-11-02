<?php

namespace Database\Factories;

use App\Models\candidatePortalInvitation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class candidatePortalInvitationFactory extends Factory
{
    protected $model = candidatePortalInvitation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'name' => $this->faker->name(),
            'sent_at' => Carbon::now(),
            'joined_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
