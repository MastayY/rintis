<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Finance & Accounting', 'description' => 'Covers topics related to financial management, accounting principles, and investment strategies.'],
            ['name' => 'Social & Community', 'description' => 'Focuses on social initiatives, community building, and societal development.'],
            ['name' => 'Health & Fitness', 'description' => 'Includes content on physical health, mental well-being, and fitness routines.'],
            ['name' => 'Education & Learning', 'description' => 'Dedicated to educational resources, learning techniques, and academic growth.'],
            ['name' => 'Technology & Gadgets', 'description' => 'Explores the latest in technology, gadgets, and innovative tools.'],
        ];

        foreach ($categories as $category) {
            Category::create([
            'name' => $category['name'],
            'slug' => Str::slug($category['name']),
            'description' => $category['description'], // Add description here
            ]);
        }
    }
}
