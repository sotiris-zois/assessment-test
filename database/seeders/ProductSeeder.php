<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = Category::all()->toArray();

        $categoryIds = array_column($categories,'id');

        $period = CarbonPeriod::create('2000-01-01', now()->format('Y-m-d'));

        $dates = [];

        foreach($period as $date){
            $dates[] = $date->format('Y-m-d');
        }

        /**
         * The test said, the total products can be more than 100 thousand, but the seeding process took
         * too long with that number
         */
        $numberOfProducts = rand(1000,3000);

        for ($i = 1; $i < $numberOfProducts; $i++) {


            DB::table('products')->insert([
                'name' => $faker->text(rand(6,10)),
                'code' => uniqid(),
                'category_id' => $categoryIds[rand(0,count($categoryIds)-1)],
                'release_date' =>$dates[rand(0,count($dates)-1)],
                'price' => $faker->randomFloat(2,10,5000)
            ]);
        }
    }
}
