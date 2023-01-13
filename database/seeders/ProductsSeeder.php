<?php

namespace Database\Seeders;

use App\Models\ModelProducts;
use Database\Factories\ProductsFactory;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Symfony\Component\Console\Helper\Table;

use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Faker = Faker::create();
        for($i = 0; $i<= 100; $i ++){
            $title = $Faker->unique()->name;
            // strip out all whitespace
            $ptitle = str_replace(' ', '-', $title);
            // convert the string to all lowercase
            $p_slug = strtolower($ptitle);
            ModelProducts::insert([
                'user_id' => '1',
                'cate_id' => '1',
                'name' => $title,
                'slug' => $p_slug,
                'small_description' => $Faker->paragraph,
                'description' => $Faker->paragraph,
                'price' => '20',
                'image' => $Faker->imageUrl,
                'qty' => $Faker->numberBetween(1,20),
                'status' => '1'
            ]);


        }

    }
}
