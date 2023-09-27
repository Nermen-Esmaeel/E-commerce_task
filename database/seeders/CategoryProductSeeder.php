<?php

namespace Database\Seeders;

use App\Models\{Category,Product};
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Category::create([
        'name' => 'Electronic',

        ]);

        Product::create([

            'category_id' => '1',
            'title' => 'Electronic',
            'description' => 'Electronic',
            'price' => '34',
            'quantity' => '4',
        ]);

    }
}
