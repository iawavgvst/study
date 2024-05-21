<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
//            "required|string" делает ошибку в случае незаполнения поля - типа "The title field is required"
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);
//        foreach ($tags as $tag) {
//            PostTag::firstOrCreate([
//                'tag_id' => $tag,
//                'post_id' => $post->id,
//            ]);
//        } способ неплохой, но менее профессиональный (???)
        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
//        dd($post->title);
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
//        $post = $post->fresh(); - можно и не использовать
        $post->tags()->sync($tags);
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
