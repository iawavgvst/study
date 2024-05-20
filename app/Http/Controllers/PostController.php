<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
//        $string = 'hello! this is start page. please, wipe your feet before entering.';
//        dd($string);

//        $post = Post:: find(1);
//        dd($posts);

//        $posts = Post::all();
//        foreach ($posts as $post)
//        {
//            dump($post->title);
//        }
//        dd('the end');

//        $posts = Post::where('is_published', true)->get();
//        foreach ($posts as $post)
//        {
//            dump($post->title);
//        }
//        dd('the end');
//        - это возможные методы вызова, для себя сохранила

        $post = Post::where('is_published', true)->first();
        dump($post->title);
        dd('the end');
    }
}
