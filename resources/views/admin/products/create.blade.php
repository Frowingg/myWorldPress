@extends('layouts.dashboard')

@section('content')
    <h1>Create</h1>

    {{-- If con il quale mi torno errori se non metto valori adatti --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="post">
        @csrf

        <div class="mb-3">
          <label class="form-label" for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}">
        </div>
        <div class="mb-3">
          <label class="form-label" for="content">Content</label>
          <input type="text" class="form-control" id="content" name="content" placeholder="Enter content" value="{{ old('title') }}">
        </div>

        <button type="submit" class="btn btn-primary">Save product</button>
      </form>

@endsection