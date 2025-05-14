<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default global categories (visible to all users)
        $defaultCategories = [
            [
                'name' => 'Makanan',
                'icon' => 'utensils',
                'color' => 'blue',
                'user_id' => null // null indicates global category
            ],
            [
                'name' => 'Transportasi',
                'icon' => 'car',
                'color' => 'purple',
                'user_id' => null
            ],
        ];

        foreach ($defaultCategories as $category) {
            Category::create($category);
        }
    }
}