<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $categories = [
            ['title' => 'Computers'],
            ['title' => 'Mobile Telephony'],
            ['title' => 'Home'],
            ['title' => 'Garden'],
            ['title' => 'Audio/Video'],
            ['title' => 'Software'],
        ];

        DB::table('categories')->insert($categories);
    }
}
