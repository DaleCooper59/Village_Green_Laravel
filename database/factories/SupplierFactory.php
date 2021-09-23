<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $address = Address::all()->pluck('id')->toArray();
        $type = ['grossiste','importateur'];
        return [
            'address_id' => rand(1,count($address)),
            'name' => $this->faker->company(),
            'tel' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'type' => $this->faker->randomElement($type),
        ];
    }
}
