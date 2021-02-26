<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'abbreviation' => $this->faker->lexify('??'),
            'name' => $this->faker->word,
            'description' =>$this->faker->word,
            'leader_member_id' => Member::factory(),
        ];
    }
}
