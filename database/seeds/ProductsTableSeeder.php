<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i < 20; $i++) {
            $new_product = new Product();
            $new_product->title = ucfirst($faker->words(rand(3, 7), true));
            $new_product->content = $faker->paragraphs(rand(5, 10), true);
            $new_product->save();
        }
    }
}
