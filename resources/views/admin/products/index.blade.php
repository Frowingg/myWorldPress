@extends('layouts.dashboard')

@section('content')
    <h1>Index</h1>

    <div class="row row-cols-3">
        @foreach($products as $product) 
            <div class="col mt-3">
                <div class="card" style="height: 100%">
                    {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        {{-- <p class="card-text">{{ $product->content }}</p> --}}
                        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection