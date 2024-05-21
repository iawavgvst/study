@extends('layouts.main')
@section('content')
    <div>
        <form action="{{ route('post.update', $post->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="title">title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="something interesting" value="{{ $post->title }}">
            </div>
            <div class="form-group">
                <label for="content">content</label>
                <textarea name="content" class="form-control" id="content" placeholder="some content">{{ $post->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">image</label>
                <input name="image" type="text" class="form-control" id="image" value="{{ $post->image }}" placeholder="some image">
            </div>
            <button type="submit" class="btn btn-primary mt-3">update</button>
        </form>
    </div>
@endsection
