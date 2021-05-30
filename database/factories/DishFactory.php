<?php

namespace Database\Factories;

use App\Models\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    protected $model = Dish::class;

    public function definition()
    {
        return [
            //
        ];
    }

    public function appetizer()
    {
        return $this->state(function (array $attributes) {
            return [
                'type_id' => 1,
            ];
        });
    }

    public function soup()
    {
        return $this->state(function (array $attributes) {
            return [
                'type_id' => 2,
            ];
        });
    }

    public function main()
    {
        return $this->state(function (array $attributes) {
            return [
                'type_id' => 3,
            ];
        });
    }

    public function side()
    {
        return $this->state(function (array $attributes) {
            return [
                'type_id' => 4,
            ];
        });
    }

    public function vegan()
    {
        return $this->state(function (array $attributes) {
            return [
                'type_id' => 5,
            ];
        });
    }

    public function sour()
    {
        return $this->state(function (array $attributes) {
            return [
                'type_id' => 6,
            ];
        });
    }

    public function dessert()
    {
        return $this->state(function (array $attributes) {
            return [
                'type_id' => 7,
            ];
        });
    }
    /*
        DishType::create([
            'id'        => 1,
            'hu_name'   => 'Előétel',
            'en_name'   => 'Appetizer',
        ]);

        DishType::create([
            'id'        => 2,
            'hu_name' => 'Leves',
            'en_name' => 'Soup',
        ]);

        DishType::create([
            'id'        => 3,
            'hu_name' => 'Főétel',
            'en_name' => 'Main dish',
        ]);

        DishType::create([
            'id'        => 4,
            'hu_name' => 'Köret',
            'en_name' => 'Side dish',
        ]);

        DishType::create([
            'id'        => 5,
            'hu_name' => 'Vega',
            'en_name' => 'Vegetarian',
        ]);

        DishType::create([
            'id'        => 6,
            'hu_name' => 'Savanyúság',
            'en_name' => 'Sour side dish',
        ]);

        DishType::create([
            'id'        => 7,
            'hu_name' => 'Desszert',
            'en_name' => 'Dessert',
        ]);

    */
}
