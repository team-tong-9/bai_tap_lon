@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">✅ ĐẶT HÀNG THÀNH CÔNG!</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <h4>Cảm ơn bạn đã đặt hàng!</h4>
                        <p>Đơn hàng của bạn đã được ghi nhận.</p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Mã đơn hàng:</th>
                                <td><strong class="text-primary">{{ $order->order_number }}</strong></td>
                            </tr>
                            <tr>
                                <th>Ngày đặt:</th>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Tổng tiền:</th>
                                <td><strong class="text-danger fs-4">{{ number_format($order->total_amount) }}đ</strong></td>
                            </tr>
                            <tr>
                                <th>Trạng thái:</th>
                                <td><span class="badge bg-warning">Chờ xử lý</span></td>
                            </tr>
                        </table>
                    </div>

                    <h5 class="mt-4">Thông tin giao hàng</h5>
                    <p>
                        <strong>{{ $order->customer_name }}</strong><br>
                        📞 {{ $order->customer_phone }}<br>
                        📍 {{ $order->customer_address }}
                    </p>

                    @if($order->note)
                        <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
                    @endif

                    <hr>

                    <h5>Chi tiết đơn hàng</h5>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>x{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price) }}đ</td>
                                <td>{{ number_format($item->price * $item->quantity) }}đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection