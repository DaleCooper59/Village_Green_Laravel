<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $address = Address::all()->pluck('id')->toArray();
      
        return [
            'address_id' => rand(1,count($address)),
            'name' =>$this->faker->company(),
            'SIRET' => trim(str_replace(' ', '',$this->faker->siret())),
        ];
    }
}
