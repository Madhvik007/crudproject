<?php

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        Post::create([
            'title' => 'First Blog Post',
            'content' => 'This is the content of the first blog post.',
            'author' => 'Admin',
            'published_at' => now(),
        ]);
    }
}
