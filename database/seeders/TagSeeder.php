<?php

namespace Database\Seeders;

use App\Models\Tag;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= Factory::create();
        foreach (range(1,10) as  $index) {
            Tag::create([
                'user_id'=>1,
                'name'=>$faker->unique()->name,
                'slug'=>Str::slug($faker->name, '-'),
                'status'=>'active'
            ]);
        }
    }
}
