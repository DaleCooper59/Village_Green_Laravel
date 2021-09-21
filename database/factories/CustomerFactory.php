<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->pluck('id')->toArray();
        $address = Address::all()->pluck('id')->toArray();
        $type = ['professionnel','particulier'];
        $choice = $this->faker->randomElement($type);
        return [
            'user_id' => rand(1,count($user)),
            'address_id' => rand(1,count($address)),
            'type' => $choice,
            'coefficient' => $choice === 'professionnel' ? 2.2 : 5.6,
        ];
    }
}
