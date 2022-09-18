@extends('layouts.dashboard')

@section('content')
    <h1>Show</h1>
    {{-- title --}}
    <h2>{{ $product->title }}</h2>
    {{-- content --}}
    <p>{{ $product->content }}</p>
    {{-- slug --}}
    <div><strong>Slug:</strong> {{ $product->slug }}</div>
    {{-- created --}}
    @if($created_days_ago > 0)
        <div> <strong> Created </strong> {{$created_days_ago}} day{{$created_days_ago > 1 ? '' : 's'}} ago. - {{ $product->created_at->format('l, j F Y') }}</div>
    @else 
        <div> <strong> Created </strong> today - {{ $product->created_at->format('l, j F Y') }}</div>
    @endif

    {{-- edit button --}}
    <div class="mt-3">
    <a class="btn btn-warning" href="{{ route('admin.products.edit', ['product' => $product->id]) }}">Modify product</a>
    </div>

    <br>
    {{-- delete button --}}
    <div>
        <form action="{{ route('admin.products.destroy', ['product'=>$product->id]) }}" method="post">
        @csrf
        @method('DELETE')
        <input class="btn btn-danger" type="submit" value="Delede post." onClick="return confirm('Are you sure?');">
        </form>
    </div>
@endsection