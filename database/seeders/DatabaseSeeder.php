<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::factory(10)->create();

        $users->each(function (User $user) {
            \App\Models\Info::factory(1)->create(['user_id' => $user->id]);

            \App\Models\Post::factory(10)->create(['user_id' => $user->id]);
        });

        $tags = \App\Models\Tag::factory(15)->create();

        Post::all()->each(function (Post $post) use ($tags, $users) {
            $post->tags()->sync($tags->random(rand(3, 5)));

            Comment::factory()->create([
                'user_id' => $users->random()->id,
                'post_id' => $post->id,
            ]);
        });
    }
}
