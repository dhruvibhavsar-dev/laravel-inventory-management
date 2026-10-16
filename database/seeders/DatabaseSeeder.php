<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Add the five categories required by the assignment if they do not already exist.
        foreach (['Raw material', 'Finish goods', 'Spares', 'Machines', 'others'] as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
