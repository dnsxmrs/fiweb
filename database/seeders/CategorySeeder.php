<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_number' => 1,
                'beverage_type' => 'iced',
                'created_at' => now(),
                'deleted_at' => null,  // Add null value for deleted_at
                'image' => 'assets/iced-coffee-icon.png',
                'name' => 'Iced Coffee',
                'type' => 'beverage',
                'updated_at' => now(),  // Add current timestamp for updated_at
            ],
            [
                'category_number' => 2,
                'beverage_type' => 'hot',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/hot-coffee-icon.png',
                'name' => 'Hot Coffee',
                'type' => 'beverage',
                'updated_at' => now(),
            ],
            [
                'category_number' => 3,
                'beverage_type' => 'iced',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/iced-non-coffee-icon.png',
                'name' => 'Iced Non-Coffee',
                'type' => 'beverage',
                'updated_at' => now(),
            ],
            [
                'category_number' => 4,
                'beverage_type' => 'hot',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/hot-non-coffee-icon.png',
                'name' => 'Hot Non-Coffee',
                'type' => 'beverage',
                'updated_at' => now(),
            ],
            [
                'category_number' => 5,
                'beverage_type' => 'iced',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/frappuccino-espresso-icon.png',
                'name' => 'Frappuccino Espresso',
                'type' => 'beverage',
                'updated_at' => now(),
            ],
            [
                'category_number' => 6,
                'beverage_type' => 'iced',
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/frappuccino-non-espresso-icon.png',
                'name' => 'Frappuccino Non-Espresso',
                'type' => 'beverage',
                'updated_at' => now(),
            ],
            [
                'category_number' => 7,
                'beverage_type' => null,
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/snack-icon.png',
                'name' => 'Snack',
                'type' => 'food',
                'updated_at' => now(),
            ],
            [
                'category_number' => 8,
                'beverage_type' => null,
                'created_at' => now(),
                'deleted_at' => null,
                'image' => 'assets/dessert-icon.png',
                'name' => 'Dessert',
                'type' => 'food',
                'updated_at' => now(),
            ],
        ]);

    }
}
