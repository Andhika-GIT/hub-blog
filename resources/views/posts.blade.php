@extends('layouts.main')

@section('container')
 <h1 class="mb-3 text-center">{{ $title }}</h1>
 
 <div class="row justify-content-center mb-4">
     <div class="col-md-6">
         <form action="/posts">
         @if (request('category'))
            {{-- /posts?category=(pilihanuser)&search=(searchuser) --}}
            <input type="hidden" name="category" value="{{ request('category') }}">
         @elseif(request('authors'))
           {{-- /posts?author=(pilihanuser)&search=(searchuser) --}}
         <input type="hidden" name="author" value="{{ request('authors') }}">
         @endif
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                <button class="btn btn-danger" type="submit">Search</button>
              </div>
        </form>
     </div>
 </div>


 {{-- jika ada postingan --}}
 @if ($posts->count())
    <div class="card mb-3">
         {{-- jika ada image yang diupload user dalam tabel post  --}}
         @if ($posts[0]->image)
            <div style="max-height: 500px; overflow:hidden">
                {{-- ambil gambar dari image dalam tabel post --}}
                <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
            </div>    
         @else
            {{-- selain itu, ambil gambar dari api unsplash --}}
            <img src="https://source.unsplash.com/random/400×1200/?{{ $posts[0]->category->name }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
        @endif
        
        <div class="card-body text-center">
        <h3 class="card-title"><a class="text-decoration-none text-dark" href="/posts/{{ $posts[0]->slug }}">{{ $posts[0]->title }}</a></h3>
        <p>
            <small class="text-muted">By, <a href="/posts?author={{ $posts[0]->author->username }}">{{ $posts[0]->author->name }}</a> in <a class="text-decoration-none" href="/posts?category={{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}
            </small>
        </p>
        <p class="card-text">{{ $posts[0]->excerpt }}</p>

        <a class="text-decoration-none btn btn-primary" href="/posts/{{ $posts[0]->slug }}">Read More</a>
        </div>
    </div>
 

    <div class="container">
        <div class="row">
        @foreach ($posts->skip(1) as $post)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-absolute bg-dark p-1 "><a class="text-decoration-none text-white" href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }}</a></div>
                    @if ($post->image)
                            {{-- ambil gambar dari image dalam tabel post --}}
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->category->name }}"> 
                    @else
                        {{-- selain itu, ambil gambar dari api unsplash --}}
                        <img src="https://source.unsplash.com/random/500×500/?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                    @endif
                   
                    <div class="card-body">
                      <h5 class="card-title"><a class="text-decoration-none" href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h5>
                      <p>
                        <small class="text-muted">By, <a href="/posts?author={{ $post->author->username }}">{{ $post->author->name }}</a> {{ $post->created_at->diffForHumans() }}
                        </small>
                     </p>
                      <p class="card-text">{{ $post->excerpt }}</p>
                      <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read More</a>
                    </div>
                  </div>
            </div>
        @endforeach    
        </div>
    </div>

 @else 
    <p class="text-center fs-4">No Post Found.</p>   
 @endif

    {{-- untuk halaman --}}
    <div class="halaman d-flex justify-content-center mt-4 mb-4">
        {{ $posts->links() }}
    </div>

@endsection

