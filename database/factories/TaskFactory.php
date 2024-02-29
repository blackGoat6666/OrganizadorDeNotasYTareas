<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(rand(5, 10)),
            'deadline' => fake()->dayOfWeek(),
            'state' => fake()->boolean(),
            'task_list_id' => \App\Models\TaskList::inRandomOrder()->first()->id,
        ];
    }
}
