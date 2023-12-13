<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= Factory::create();
        // $id=rand(50,500);
        // $image=""
        foreach (range(1,10) as  $index) {
            Post::create([
                'user_id'=>1,
                'title'=>$faker->unique()->name,
                'description'=>$faker->paragraph,
                'image'=>$faker->imageUrl(),
                'slug'=>Str::slug($faker->name, '-'),
                'published_at'=>$faker->date('y-m-d'),
                'status'=>'active',
                'is_approved'=>'approved'
            ]);
        }
    }
}
