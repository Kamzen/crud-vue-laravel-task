<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        //
        DB::table('product_variants')->insert([
            [
                'sap_product_code' => 'ZROY132000',
                'web_product_code' => 'ZRC0279',
                'variant_name' => 'Royal Canin Babydog Milk for Puppies',
                'product_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'sap_product_code' => 'ZROY402020',
                'web_product_code' => 'ZRC0155',
                'variant_name' => 'Royal Canin Mini Adult Dog Food 2 KG',
                'product_id' => 2,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'sap_product_code' => 'ZROY402080',
                'web_product_code' => 'ZRC0099',
                'variant_name' => 'Royal Canin Mini Ageing 12+ Adult Dog Food',
                'product_id' => 3,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'sap_product_code' => 'ZROY408015',
                'web_product_code' => 'ZRC0221',
                'variant_name' => 'Royal Canin Mini Adult Dog Food 8 KG',
                'product_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
