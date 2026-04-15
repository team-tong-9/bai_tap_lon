@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->order_number)

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <!-- Thông tin đơn hàng -->
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Chi tiết đơn hàng #{{ $order->order_number }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}<br>
                                        <small class="text-muted">Mã SP: {{ $item->product_id }}</small>
                                    </td>
                                    <td>{{ number_format($item->price) }}đ</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->subtotal) }}đ</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Tổng cộng:</th>
                                    <th>{{ number_format($order->total_amount) }}đ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Thông tin giao hàng -->
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Thông tin giao hàng</h5>
                </div>
                <div class="card-body">
                    <p><strong>Người nhận:</strong> {{ $order->user->name }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
                    @if($order->notes)
                        <p><strong>Ghi chú của khách:</strong> {{ $order->notes }}</p>
                    @endif
                    @if($order->admin_notes)
                        <p><strong>Ghi chú của admin:</strong> {{ $order->admin_notes }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Cập nhật trạng thái -->
            <div class="card shadow mb-4">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Cập nhật trạng thái</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Trạng thái đơn hàng</label>
                            <select name="status" class="form-control" required>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Cập nhật trạng thái</button>
                    </form>
                </div>
            </div>

            <!-- Cập nhật thanh toán -->
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Cập nhật thanh toán</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.updatePayment', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label>Trạng thái thanh toán</label>
                            <select name="payment_status" class="form-control" required>
                                <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                                <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                                <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Đã hoàn tiền</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Phương thức thanh toán chi tiết</label>
                            <input type="text" name="payment_method_detail" class="form-control" value="{{ $order->payment_method_detail }}" placeholder="VD: Chuyển khoản MB Bank, Tiền mặt...">
                        </div>
                        <div class="mb-3">
                            <label>Ghi chú (Admin)</label>
                            <textarea name="admin_notes" class="form-control" rows="2">{{ $order->admin_notes }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Cập nhật thanh toán</button>
                    </form>
                </div>
            </div>

            <!-- Xuất hóa đơn -->
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Hóa đơn</h5>
                </div>
                <div class="card-body text-center">
                    @if($order->invoice_number)
                        <p><strong>Số hóa đơn:</strong> {{ $order->invoice_number }}</p>
                        <p><strong>Ngày thanh toán:</strong> {{ $order->payment_date ? date('d/m/Y', strtotime($order->payment_date)) : 'Chưa thanh toán' }}</p>
                    @else
                        <p class="text-muted">Chưa có hóa đơn</p>
                    @endif
                    <a href="{{ route('admin.orders.invoice', $order->id) }}" class="btn btn-danger w-100" target="_blank">
                        <i class="fas fa-print"></i> Xuất hóa đơn
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
