<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use App\Models\Facility;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'start_date' => fake()->dateTimeBetween('+1 days', '+30 days'),
            'end_date' => fake()->dateTimeBetween('+1 days', '+30 days'),
            'location' => fake()->city(),
            'facility_id' => null,
            'user_id' => User::factory(),
            'is_public' => fake()->boolean(80), // 80% publiczne
        ];
    }
}
