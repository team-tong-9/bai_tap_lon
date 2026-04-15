@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Giỏ hàng của bạn</h1>

    @if($cart->items->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tạm tính</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart->items as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->product->image }}" width="50" class="me-2 rounded">
                            {{ $item->product->name }}
                        </td>
                        <td>{{ number_format($item->product->price) }}đ</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex gap-2">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 70px;">
                                <button type="submit" class="btn btn-sm btn-warning">Cập nhật</button>
                            </form>
                         </td>
                        <td>{{ number_format($item->subtotal) }}đ</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                         </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="3" class="text-end">Tổng cộng:</th>
                        <th colspan="2">{{ number_format($cart->total) }}đ</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Xóa toàn bộ giỏ hàng?')">
                        <i class="fas fa-trash"></i> Xóa toàn bộ
                    </button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('orders.checkout') }}" class="btn btn-primary-custom btn-lg">
                    <i class="fas fa-credit-card"></i> Tiến hành thanh toán
                </a>
            </div>
        </div>
    @else
        <div class="alert alert-info text-center py-5">
            <i class="fas fa-shopping-cart fa-4x mb-3"></i>
            <p>Giỏ hàng của bạn đang trống!</p>
            <a href="{{ route('products') }}" class="btn btn-primary-custom">Tiếp tục mua sắm</a>
        </div>
    @endif
</div>
@endsection
