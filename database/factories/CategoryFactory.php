<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $parent = Category::all()->pluck('id')->toArray();
        
        return [
            //'name' => $this->faker->city(),
            'parent_id' => rand(1,count($parent))
        ];
    }
}
