@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🛒 Giỏ hàng của bạn</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(!empty($cart) && count($cart) > 0)
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ number_format($item['price']) }}đ</td>
                    <td>
                        <form action="{{ route('cart.update', $id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 70px;">
                            <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                        </form>
                    </td>
                    <td class="text-danger fw-bold">{{ number_format($item['price'] * $item['quantity']) }}đ</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                    <td colspan="2"><strong class="text-danger fs-5">{{ number_format($total) }}đ</strong></td>
                </tr>
            </tfoot>
        </table>
        <div class="text-end mt-3">
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Tiếp tục mua sắm</a>
    <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg ms-2">✅ Thanh toán ngay</a>
</div>
    @else
        <div class="alert alert-info text-center">
            Giỏ hàng trống! <a href="{{ route('products.index') }}">Mua sắm ngay</a>
        </div>
    @endif
</div>
@endsection