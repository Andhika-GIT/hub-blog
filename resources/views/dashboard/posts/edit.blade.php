@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Post</h1>
</div>

<div class="col-lg-8">
     {{-- method form hanya bisa dua, get atau post --}}
     {{-- kirim data slug --}}
    <form method="post" action="/dashboard/posts/{{ $post->slug }}" class="mb-5" enctype="multipart/form-data">
        {{-- oleh karena itu kita tambahkan method sendiri yaitu put, yang akan otomatis masuk ke dashboardcontroller dengan function update --}}
        @method('put')
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror " 
          {{-- laravel akan mengecheck, jika tidak ada value old, maka akan ditampilkan value data yang dikirim dari controller --}}
          id="title" name="title" value="{{ old('title', $post->title) }}">
          @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly value="{{ old('slug', $post->slug) }}" >
          @error('slug')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select class="form-select" name="category_id">
            @foreach ($categories as $category)
              @if (old('category_id', $post->category_id) == $category->id)
                <option option value="{{ $category->id }}" selected>{{ $category->name }}</option>  
              @else
                <option option value="{{ $category->id }}">{{ $category->name }}</option>  
              @endif 
            @endforeach
          </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Post image</label>
            {{-- input hidden untuk mengirim data image lama --}}
            <input type="hidden" name="oldImage" value="{{ $post->image }}">
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="document.querySelector('.img-preview').src = window.URL.createObjectURL(this.files[0])">

            @if ($post->image)
                {{-- jika ada gambar pada tabel post, img ada berisi link gambar --}}
                <img src="{{ asset('storage/' . $post->image) }}" class="img-preview img-fluid mb-3 mt-5 col-sm-5">
            @else
                <img class="img-preview img-fluid mb-3 mt-5 col-sm-5">
            @endif 

            @error('image')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror

      </div>
        <div class="mb-3">
          <label for="category" class="form-label">Body</label>
          @error('body')
              <p class="text-danger">{{ $message }}</p>
          @enderror
          <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
          <trix-editor input="body"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>

{{-- buat script fetch --}}
<script>
    // ambil input title dan slug
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    // ketika title diketik atau berubah (change)
    title.addEventListener('change', function() {
        // kirimkan fetch data ke controller dashboard dengan mengirim hasil title (title.value)
        // atur controller mana yang mengolah di route web.php
        fetch('/dashboard/posts/createSlug?title=' + title.value)
        // jika berhasil kembalikan hasil dalam bentuk json 
        .then(response => response.json())
        // ubah input value dari slug dengan data 'slug' yang dikirim dari method createslug pada controller dashboardpostcontroller
        .then(data => slug.value = data.slug)
    });

    // hilangkan fungsi upload file pada trix editor
    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault();
    })
</script>
@endsection