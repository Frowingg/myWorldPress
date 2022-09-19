@extends('layouts.dashboard')

@section('content')
    <h1>Index</h1>

    @if($deleted == 'yes')
        <div class="alert alert-success" role="alert">
            Post deleted correctly.
        </div>
    @endif

    <div class="row row-cols-3">
        @foreach($products as $product) 
            <div class="col mt-3">
                <div class="card" style="height: 100%">
                    {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        {{-- gli indico la rotta per lo show e gli passo l'id --}}
                        <a href="{{ route('admin.products.show', ['product' => $product->id]) }}" class="btn btn-primary">See product.</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>
@endsection