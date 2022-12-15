@extends('layouts.main')

@section('container')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           
                <h2 class="mb-4">{{ $post->title }}</h2>
                <p>By, <a class="text-decoration-none" href="/posts?authors={{ $post->author->username }}">{{ $post->author->name }}</a>  in <a href="/posts?categories={{ $post->category->slug }}">{{ $post->category->name }}</a></p>

                @if ($post->image)
                        {{-- ambil gambar dari image dalam tabel post --}}
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="{{ $post->category->name }}"> 
                @else
                    {{-- selain itu, ambil gambar dari api unsplash --}}
                    <img src="https://source.unsplash.com/random/500×400?{{ $post->category->name }}" class="img-fluid">
                @endif
                
                <article class="my-3 fs-5">
                    {{-- tidak melakukan escape html --}}
                    {!! $post->body !!}
                </article>
                
                <a  href="/posts" class="d-block mt-3 mb-5">Back to posts</a> 
        </div>
    </div>
</div>
   
@endsection