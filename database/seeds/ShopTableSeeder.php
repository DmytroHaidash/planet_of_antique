<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_En');
        $users = User::where('role', 'seller')->get();
        $users [] = User::where('role', 'admin')->first();
        foreach ($users as $user){
            $shop = $user->shop()->create(['slug' => $faker->word, 'title' => ['en' => ucfirst($faker->sentence)]]);
            $shop->addMediaFromUrl($this->robohash($faker->word, 1920, 900))->toMediaCollection('banner');
            $shop->addMediaFromUrl($this->robohash($faker->word, 600, 600))->toMediaCollection('logo');
        }
    }

    public function robohash($name = 'robot', $width = 200, $height = 200, $background = false, $secure = true)
    {
        $baseUrl = ($secure) ? "https://robohash.org/" : "http://robohash.org";
        $url = "{$name}.png?size={$width}x{$height}";

        if ($background) {
            $url .= "&bgset=bg".$this->randomDigit;
        }

        return $baseUrl.$url;
    }
}
