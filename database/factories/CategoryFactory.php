<?php

namespace Database\Factories;

use App\Models\categories;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = categories::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name'=>$this->faker->array()->randomElement($array =['deportes','farandula','bolsa de trabajo','entretenimiento']),
        ];
    }
}
