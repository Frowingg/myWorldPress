@extends('layouts.dashboard')

@section('content')
    <h1>Show</h1>

    <h2>{{ $product->title }}</h2>
    <p>{{ $product->content }}</p>
    <div>{{ $product->created_at }}</div>

    <a class="btn btn-warning" href="{{ route('admin.products.edit', ['product' => $product->id]) }}">Modify product</a>

@endsection