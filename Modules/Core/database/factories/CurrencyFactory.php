<?php

namespace Modules\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Core\Models\Currency::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

