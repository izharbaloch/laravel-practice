<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Technology', 'Health', 'Lifestyle', 'Education', 'Travel'];

        foreach ($categories as $category) {
            \App\Models\Category::create(['name' => $category]);
        }

        User::firstOrCreate([
            'name' => 'izhar baloch',
            'email' => 'izharbaloch570@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
