<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
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
            Category::create([
                'user_id'=>1,
                'name'=>$faker->unique()->name,
                'slug'=>Str::slug($faker->name, '-'),
                'status'=>'active'
            ]);
        }

    }
}
