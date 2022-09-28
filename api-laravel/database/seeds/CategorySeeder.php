<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{




    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            [
                'category_name' => 'Dog Dry Food',
                'category_meta_title' => 'Buy Dog Dry Food in South Africa Online at ePETstore.co.za',
                'category_meta_desc' => "Shop our full range of Eukanuba, Royal Canin, Vet's Choice and Earthborn dry dog food now. Every palate is covered.",
                'category_meta_keywords' => "Eukanuba, large breed, small breed, medium breed, puppy, adult, mature &amp; senior, EVD, eukanuba veterinary diets,
                Yorkshire Terrier, Working &amp; endurance, weight control, lamb &amp; rice, daily care, sensitive joints, sensitive skin, sensitive diges",
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'category_name' => 'Cat Treats',
                'category_meta_title' => 'Buy Cat Toys in South Africa Online at ePETstore.co.za',
                'category_meta_desc' => 'A complementary range of cat scratchers, interactive feeders and toys to entertain your cat 24/7. Buy now.',
                'category_meta_keywords' => 'Catit speed circuit, scratching post, feather wand, woolly monster, crazy ear mouse, catnip mouse, twinkle ball, kong, slimcat interactive ball, snuggle and rest, orakat, wiggle worm, laser fun toy, breath mint stick, feather buddy, easy life scratcher ha',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'category_name' => 'Cat Treats',
                'category_meta_title' => 'Buy Cat Treats in South Africa Online at ePETstore.co.za',
                'category_meta_desc' => 'Spoil your cat with Iams or Royal Canin pouches, Greenies dental treats and catnip options to make them purr.',
                'category_meta_keywords' => "Catnip, Iams, Royal Canin, pouches, Greenies dental treats, salmon, ocean fish, chicken, kitten, adult, senior, ocean fish, instinctive, beauty, jelly, light, catnip drops",
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
