<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;

class IndexController extends BaseController
{
    public function __invoke()
    {
//        $this->authorize('view', auth()->user());
        $posts = Post::paginate(3);
        return view('post.index', compact('posts'));
    }
}
