<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostsController
{
    public function index()
    {
        $posts = Post::all();

        return view('posts', ['items' => $posts]);
    }
}
