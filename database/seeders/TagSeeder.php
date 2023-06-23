<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['title' => 'Laptop'],
            ['title' => 'Desktop'],
            ['title' => 'Tablet'],
            ['title' => 'Android'],
            ['title' => 'iPhone'],
            ['title' => 'Home Cinema'],
            ['title' => 'Furniture'],
            ['title' => 'Lighting'],
            ['title' => 'Decoration'],
            ['title' => 'Bathroom'],
            ['title' => 'Kitchen'],
            ['title' => 'Living Room'],
            ['title' => 'Bedroom'],
            ['title' => 'Speakers'],
            ['title' => 'Microphone'],
            ['title' => 'Smart TV'],
            ['title' => 'Full HD'],
            ['title' => '4K'],
            ['title' => 'Internet Security'],
            ['title' => 'Design'],
            ['title' => 'Sound Engineering'],
        ];

        DB::table('tags')->insert($tags);
    }
}
