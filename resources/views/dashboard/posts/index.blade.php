@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Post</h1>
</div>

{{-- mengecheck apakah ada session flash bernama success --}}
@if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="table-responsive col-lg-12">
  {{-- arahkan ke controller dashboard dengan method create --}}
  <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create New Post</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($posts as $post)
          <tr>
              {{-- $loop->iteration untuk loop otomatis(baca dokumentasi) --}}
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name }}</td>
            <td>
                <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>

                {{-- kirim data slug, lalu tambahkan /edit, merupakan aturan default, agar diarahkan ke controller dashboard dengan function edit --}}
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>

                {{-- method form hanya bisa dua, get atau post --}}
                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                  {{-- oleh karena itu kita tambahkan method sendiri yaitu delete, yang akan otomatis masuk ke dashboardcontroller dengan function destroy --}}
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                </form>
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>

@endsection