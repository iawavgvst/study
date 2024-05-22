@extends('layouts.main')
@section('content')
    <div>
        <div>
            <a href="{{ route('post.create') }}" class="btn btn-outline-info mb-3">add one</a>
        </div>
        @foreach($posts as $post)
            <div><a href="{{ route('post.show', $post->id) }}">{{ $post->id }}. {{ $post->title }}</a></div>
        @endforeach
        <div class="mt-3">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
