<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Todo>
 */
class TodoFactory extends Factory
{
    protected $model = Todo::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'completed' => false,
        ];
    }

    public function completed(): static
    {
        return $this->state(fn () => ['completed' => true]);
    }
}
