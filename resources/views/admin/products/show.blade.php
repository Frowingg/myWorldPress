@extends('layouts.dashboard')

@section('content')
    <h1>Show</h1>

    <h2>{{ $product->title }}</h2>
    <p>{{ $product->content }}</p>
    <div>{{ $product->created_at }}</div>
    <div>
    <a class="btn btn-warning" href="{{ route('admin.products.edit', ['product' => $product->id]) }}">Modify product</a>
    </div>
    <br>
    <div>
        <form action="{{ route('admin.products.destroy', ['product'=>$product->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <input class="btn btn-danger" type="submit" value="Delede post." onClick="return confirm('Are you sure?');">
        </form>
    </div>
@endsection