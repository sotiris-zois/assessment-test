<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagsProductsPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all()->pluck('id')->toArray();
        $tags = Tag::all()->pluck('id')->toArray();

        $totalTags = count($tags)-1;

        $rows = [];

        foreach ($products as $productId) {
            $numTags = rand(2,6);

            for( $i=0; $i < $numTags; $i++){

                $rows[] = [
                    'tag_id' => $tags[rand(0,$totalTags)],
                    'product_id' => $productId
                ];
            }
        }

        DB::table('tags_products_pivot')->insert($rows);
    }
}
