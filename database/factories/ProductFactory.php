<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       
            
            
            return [
                'label' => 'numl',
                'ref' => 'numl',
                'picture' => 'null',
                'description' => 'null',
                'EAN' => 'numl',
                'color' => 'null',
                'unit_price_HT' => 12.5,
                'supply_ref' => 'numl',
                'supply_name' => 'null',
                'supply_unit_price_HT' => 12.4,
                'stock' => 4,
                'stock_alert' => 4,
            ];
        
    }
}
