<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $country = Country::all()->pluck('id')->toArray();
        
        return [
            'country_id' => rand(1,count($country)),
            'name' => $this->faker->city(),
            'postal_code' => $this->faker->postcode() 
        ];
    }
}
