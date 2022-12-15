@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
           
                <h2 class="mb-4">{{ $post->title }}</h2>
                <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span>Back To All Post Posts</a>

                {{-- kirim data slug, lalu tambahkan /edit, merupakan aturan default, agar diarahkan ke controller dashboard dengan function edit --}}
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span>Edit</a>
                
                 {{-- method hanya bisa dua, get atau post --}}
                 <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                    {{-- oleh karena itu kita tambahkan method sendiri yaitu delete, yang akan otomatis masuk ke dashboardcontroller dengan function destroy --}}
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
                  </form>

                {{-- jika ada image yang diupload user dalam tabel post  --}}
                @if ($post->image)
                  <div style="max-height: 500px; overflow:hidden">
                      {{-- ambil gambar dari image dalam tabel post --}}
                      <img class="mt-4" src="{{ asset('storage/' . $post->image) }}" class="img-fluid">
                  </div>    
                @else
                    {{-- selain itu, ambil gambar dari api unsplash --}}
                    <img class="mt-4" src="https://source.unsplash.com/random/500×400?{{ $post->category->name }}" class="img-fluid">
                @endif
               

                <article class="my-3 fs-5">
                    {{-- tidak melakukan escape html --}}
                    {!! $post->body !!}
                </article> 
        </div>
    </div>
</div>

@endsection