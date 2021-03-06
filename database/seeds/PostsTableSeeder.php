<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for( $i = 0; $i < 10; $i++){
            $newPost = new Post();
            $newPost->title = $faker->words(5, true);
            $newPost->content = $faker->text();
            // $newPost->published = $faker->boolean();
            $newPost->published = rand(0,1);
            $newPost->slug = Str::of($newPost->title)->slug('-');
            $newPost->save(); 
        }
    }
}
