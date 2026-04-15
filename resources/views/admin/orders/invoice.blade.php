<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HÓA ĐƠN #{{ $order->invoice_number }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', 'Segoe UI', Arial, sans-serif;
            font-size: 14px;
            padding: 20px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #e74c3c;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #e74c3c;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .info-box {
            width: 48%;
        }
        .info-box h4 {
            margin: 0 0 10px 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        .total-row {
            text-align: right;
            font-weight: bold;
            font-size: 16px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .status-paid { background: #28a745; color: white; }
        .status-unpaid { background: #dc3545; color: white; }
        @media print {
            body { padding: 0; }
            .invoice-box { box-shadow: none; border: none; }
            .no-print { display: none; }
        }
        .no-print {
            text-align: center;
            margin-top: 20px;
        }
        .btn-print {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h1>SHOP_MOTOVN</h1>
            <p>Chuyên cung cấp xe máy chính hãng</p>
            <p>123 Đường Lê Lợi, Quận 1, TP.HCM | Hotline: 0123 456 789</p>
        </div>

        <div class="info-row">
            <div class="info-box">
                <h4>THÔNG TIN HÓA ĐƠN</h4>
                <p><strong>Số hóa đơn:</strong> {{ $order->invoice_number }}</p>
                <p><strong>Mã đơn hàng:</strong> {{ $order->order_number }}</p>
                <p><strong>Ngày xuất:</strong> {{ date('d/m/Y H:i:s') }}</p>
            </div>
            <div class="info-box">
                <h4>THÔNG TIN KHÁCH HÀNG</h4>
                <p><strong>Họ tên:</strong> {{ $order->user->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ number_format($item->price) }}đ</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->subtotal) }}đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-row">
            <p>Tổng cộng: <strong>{{ number_format($order->total_amount) }}đ</strong></p>
        </div>

        <div class="info-row">
            <div class="info-box">
                <h4>PHƯƠNG THỨC THANH TOÁN</h4>
                <p>
                    @if($order->payment_method == 'cod')
                        Thanh toán khi nhận hàng (COD)
                    @else
                        Chuyển khoản ngân hàng
                    @endif
                </p>
                @if($order->payment_method_detail)
                    <p><strong>Chi tiết:</strong> {{ $order->payment_method_detail }}</p>
                @endif
            </div>
            <div class="info-box">
                <h4>TÌNH TRẠNG</h4>
                <p>
                    <strong>Trạng thái đơn hàng:</strong>
                    @if($order->status == 'pending') Chờ xử lý
                    @elseif($order->status == 'processing') Đang xử lý
                    @elseif($order->status == 'completed') Hoàn thành
                    @else Đã hủy
                    @endif
                </p>
                <p>
                    <strong>Thanh toán:</strong>
                    @if($order->payment_status == 'paid')
                        <span class="status-badge status-paid">Đã thanh toán</span>
                    @else
                        <span class="status-badge status-unpaid">Chưa thanh toán</span>
                    @endif
                </p>
                @if($order->payment_date)
                    <p><strong>Ngày thanh toán:</strong> {{ date('d/m/Y', strtotime($order->payment_date)) }}</p>
                @endif
            </div>
        </div>

        <div class="footer">
            <p>Cảm ơn quý khách đã mua hàng tại Shop_MotoVn!</p>
            <p><em>Hóa đơn này được tạo tự động từ hệ thống</em></p>
        </div>
    </div>

    <div class="no-print">
        <button onclick="window.print()" class="btn-print">
            <i class="fas fa-print"></i> In hóa đơn
        </button>
        <br><br>
        <a href="{{ route('admin.orders.show', $order->id) }}">← Quay lại</a>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>
