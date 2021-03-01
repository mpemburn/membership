<?php

namespace Database\Factories;

use App\Models\Circle;
use Illuminate\Database\Eloquent\Factories\Factory;

class CircleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Circle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'circle' => $this->faker->word
        ];
    }
}
