<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Faker\Provider\Base;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request) // реквест нужно вставить в виде аргумента
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('post.index');
    }
}
