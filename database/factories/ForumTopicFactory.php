<?php

namespace Database\Factories;

use App\Models\ForumCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ForumTopic>
 */
class ForumTopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => ForumCategory::factory(),
            'user_id' => User::factory(),
            'title' => fake()->sentence(),
            'is_pinned' => fake()->boolean(10),
            'is_locked' => false,
            'views' => fake()->numberBetween(0, 1000),
        ];
    }
}
