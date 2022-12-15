@extends('layouts.main')

@section('container')
    <h1 class="mb-5">Post Category : {{ $title }}</h1>
    
    @foreach ($posts as $post)
    <article class="mb-5">
        <h2>
            <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
        </h2>
        <p>{{ $post->slug }}</p>
    </article>
        
    @endforeach

@endsection

