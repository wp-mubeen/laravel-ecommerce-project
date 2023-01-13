<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Faker\Factory;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
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
            User::insert([
                'name' => $Faker->name(),
                'email' => $Faker->email,
                'is_admin' => '0',
                'password' => Hash::make('12345678')
            ]);
        }

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'is_admin' => '1',
            'password' => Hash::make('12345678'),
        ]);
    }
}
