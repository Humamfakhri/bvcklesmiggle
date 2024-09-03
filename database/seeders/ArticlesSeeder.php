<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample categories
        // $categories = ['Technology', 'Health', 'Lifestyle', 'Education', 'Business'];

        // Loop through and create categories
        // foreach ($categories as $categoryName) {
            // $category = Category::firstOrCreate(['name' => $categoryName]);

            // Create articles for each category
            // for ($i = 1; $i <= 5; $i++) { // Creating 5 articles per category
                // Article::create([
                    // 'title' => "Sample Article Title {$i} in {$categoryName}",
                    // 'author' => "Author {$i}",
                    // 'body' => "This is the body of Sample Article {$i} in {$categoryName}.",
                // ])->categories()->attach($category->id);
            // }
        // }
    }
}
