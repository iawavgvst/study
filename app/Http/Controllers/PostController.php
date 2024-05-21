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

        $posts = Post::all();

        return view('posts', compact('posts'));
    }

    public function create()
    {
        $postsArr = [
            [
                'title' => 'title of post from phpstorm',
                'content' => 'something interesting',
                'image' => 'someimage.jpg',
                'likes' => 13,
                'is_published' => true,
            ],
            [
                'title' => 'another title of post from phpstorm',
                'content' => 'something even more interesting',
                'image' => 'another someimage.jpg',
                'likes' => 150,
                'is_published' => true,
            ]
        ];

//        Post::create([
//            'title' => 'another title of post from phpstorm',
//            'content' => 'something even more interesting',
//            'image' => 'another someimage.jpg',
//            'likes' => 150,
//            'is_published' => true,
//        ]);
//
//        dd('created');

        foreach ($postsArr as $item)
        {
            Post::create($item);
        }

        dd('created');
    }

    public function update()
    {
        $post = Post::find(6);
        $post->update([
            'title' => 'updated',
            'content' => 'updated',
            'image' => 'updated',
            'likes' => 1000,
            'is_published' => false,
        ]);

        dd('updated');
    }

//    public function delete()
//    {
//        $post = Post::find(6);
//        $post->delete();
//        dd('deleted');
//    }

    public function delete()
    {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('deleted');
    }

//    firstOrCreate - нужно подтянуть данные, которых еще нет, из базы; иногда нужно для проверки дубликатов
//    updateOrCreate - тоже проверка дубликатов (если нет совпадений - создается, если есть измененные данные, но есть такие же атрибуты - апдейтится)

    public function firstOrCreate()
    {
//        $post = Post::find(1);

        $anotherPost = [
            'title' => 'some post',
            'content' => 'some content',
            'image' => 'some image.jpg',
            'likes' => 100000,
            'is_published' => true,
        ];

        $post = Post::firstOrCreate([
            'title' => 'some post'
        ], [
            'title' => 'some post',
            'content' => 'some content',
            'image' => 'some image.jpg ',
            'likes' => 100000,
            'is_published' => true,
        ]);

        dump($post->content);
        dd('finished');
    }

    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => 'update or create title',
            'content' => 'update or create content',
            'image' => 'update or create image.jpg',
            'likes' => 350,
            'is_published' => true,
        ];

        $post = Post::updateOrCreate([
            'title' => 'some post or not'
        ], [
            'title' => 'some post or not',
            'content' => 'impossible update or create content',
            'image' => 'impossible update or create image.jpg',
            'likes' => 350,
            'is_published' => true,
        ]);

        dump($post->content);
        dd('hiiiiiii');
    }
}
