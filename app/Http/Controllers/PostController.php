<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
//        $posts = Post::all();

//        $category = Category::find(1);

        $post = Post::find(1);
        $tag = Tag::find(1);

        dd($tag->posts);

//        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);
        Post::create($data);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
//        dd($post->title);
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);

        $post->update($data);
        return redirect()->route('post.show', $post->id);
    }

    public function delete()
    {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('deleted');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

    //то, что наверху - урок CRUD через интерфейс

//    public function delete()
//    {
//        $post = Post::find(6);
//        $post->delete();
//        dd('deleted');
//    }

//    public function delete()
//    {
//        $post = Post::withTrashed()->find(2);
//        $post->restore();
//        dd('deleted');
//    }

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
