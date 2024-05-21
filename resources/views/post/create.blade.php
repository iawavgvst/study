@extends('layouts.main')
@section('content')
    <div>
        <form action="{{ route('post.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="something interesting">
            </div>
            <div class="form-group">
                <label for="content">content</label>
                <textarea name="content" class="form-control" id="content" placeholder="some content"></textarea>
            </div>
            <div class="form-group">
                <label for="image">image</label>
                <input name="image" type="text" class="form-control" id="image" placeholder="some image">
            </div>
            <button type="submit" class="btn btn-primary mt-3">create</button>
        </form>
    </div>
@endsection
