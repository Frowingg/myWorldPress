@extends('layouts.dashboard')

@section('content')
    <h1>Edit</h1>

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

    <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label" for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ old('title') ? old('title') : $product->title }}">
        </div>
        <div class="mb-3">
          <label class="form-label" for="content">Content</label>
          <input type="text" class="form-control" id="content" name="content" placeholder="Enter content" value="{{ old('content') ? old('content') : $product->content }}">
        </div>

        <div class="mb-3">
          <label for="category_id">Category</label>
          <select name="category_id" id="category_id" class="form-select">
              <option value="">Nessuna</option>

              @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
              @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Save product</button>
      </form>

@endsection