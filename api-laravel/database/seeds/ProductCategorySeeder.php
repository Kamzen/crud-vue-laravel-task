<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('product_categories')->insert([
            [
                'product_id' => 1,
                'category_id' => 1
            ],
            [
                'product_id' => 2,
                'category_id' => 1
            ],
            [
                'product_id' => 3,
                'category_id' => 2
            ],
            [
                'product_id' => 1,
                'category_id' => 3
            ]
        ]);
    }
}
