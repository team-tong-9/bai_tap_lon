@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">🏍️ Danh sách xe máy</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>{{ $product->name }}</h5>
                    <p class="text-danger fw-bold">{{ number_format($product->price) }}đ</p>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">🛒 Thêm vào giỏ</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection