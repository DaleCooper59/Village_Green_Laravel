<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->pluck('id')->toArray();
        $company = Company::all()->pluck('id')->toArray();
        $department = ['Vendeur professionnel','Vendeur particulier'];
        return [
            'user_id' => $this->faker->unique(true)->numberBetween(1,count($user)),
            'company_id' => rand(1,count($company)),
            'department' => $this->faker->randomElement($department),
        ];
    }
}
