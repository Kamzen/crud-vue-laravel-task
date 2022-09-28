<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
//name	slug
//Royal Canin Babydog Milk for Puppies	royal-canin-baby-dog-milk-junior-milk-dog-food
//Royal Canin Mini Adult Dog Food	royal-canin-mini-adult-dry-dog-food
//Royal Canin Mini Ageing 12+ Adult Dog Food	royal-canin-mini-ageing-adult-dry-dog-food
//Royal Canin Mini Exigent Adult Dog Food	royal-canin-mini-exigent-adult-dry-dog-food
//Royal Canin Mini Puppy Food	royal-canin-mini-junior-puppy-dry-dog-food
//Royal Canin Mini Light Weight Care Dog Food	royal-canin-mini-light-adult-dry-dog-food
//Royal Canin Mini Digestive Care Adult Dog Food	royal-canin-mini-digestive-care-adult-dry-dog-food


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('products')->insert([
            [
            'product_name' => 'Royal Canin Baby dog Milk for Puppies',
            'slug' => "royal-canin-baby-dog-milk-junior-milk-dog-food",
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'product_name' => 'Royal Canin Mini Ageing 12+ Adult Dog Food',
                'slug' => 'royal-canin-mini-adult-dry-dog-food',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'product_name' => 'Royal Canin Mini Adult Dog Food',
                'slug' => 'royal-canin-mini-adult-dry-dog-food',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
