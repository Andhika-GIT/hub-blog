@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Post</h1>
</div>

<div class="col-lg-8">
    {{-- jika memakai route resource, method post akan otomatis ke controller dengan method store --}}
    <form method="post" action="/dashboard/posts" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror " id="title" name="title" value="{{ old('title') }}">
          @error('title')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" readonly value="{{ old('slug') }}" >
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
              @if (old('category_id') == $category->id)
                <option option value="{{ $category->id }}" selected>{{ $category->name }}</option>  
              @else
                <option option value="{{ $category->id }}">{{ $category->name }}</option>  
              @endif 
            @endforeach
          </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Post image</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="document.querySelector('.img-preview').src = window.URL.createObjectURL(this.files[0])">
            <img class="img-preview img-fluid mb-3 mt-5 col-sm-5">
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
          <input id="body" type="hidden" name="body" value="{{ old('body') }}">
          <trix-editor input="body"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Create Post</button>
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
    });

    // membuat preview image
    // function previewImage () {
    //   const image = document.querySelector('#image');
    //   const imgPreview = document.querySelector('.img-preview');

    //   imgPreview.style.display = 'block';

    //   // membaca file
    //   const oFReader = new FileReader();
    //   oFReader.readAsDataUrl(image.files[0]);

    //   // ketika file diload
    //   oFReader.onload = function(oFREvent) {
    //     // src image akan diganti dari file yang diload, agar preview tampil
    //     imgPreview.src = oFREvent.target.result;
    //   }
    // };

</script>
@endsection