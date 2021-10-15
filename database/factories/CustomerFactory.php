<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Employee;
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
        $type = ['professionnel','particulier'];
        $choice = $this->faker->randomElement($type);
        $coef = $choice === 'professionnel' ? 2.2 : 5.6;
        $arr  = ['2', '3', '4', '5'];
        $eID = $choice === 'professionnel' ? (rand(2, count($arr))+1) : 1;
        
        return [
            'user_id' => $this->faker->unique(true)->numberBetween(1,count($user)),
            'employee_id' => $eID,
            'ref_customer' => $this->faker->randomElement($arr),
            'type' => $choice,
            'coefficient' => $coef,
        ];
    }
}
