<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Blogger,Blog};
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = Blogger::where('status','Active')->pluck('id')->toArray();
        
        $faker = Faker::create();
        foreach (range(1, 5) as $index) {
        $super = Blog::create([
            
            'blogger_id' => $faker->randomElement($array),
            'title' => $faker->name,
            'content' => $faker->text($maxNbChars = 200),
            'status' => 'Active',
           ]);
        }
    }
}
