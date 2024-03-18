<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
    protected $model=Product::class;
    public function definition(): array
    {
        return [
           /* 'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'satatus'=>$this->faker->word,
            'category_id' => Category::factory()->create(),
            'user_id'=>User::factory()->create(),*/

        ];
    }
}
