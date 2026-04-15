<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $orders = Order::with('user')->orderBy('id', 'desc')->paginate(15);
        $statusCounts = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');

        return view('admin.orders.index', compact('orders', 'statusCounts', 'totalRevenue'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);

        DB::beginTransaction();

        try {
            // Nếu hủy đơn, hoàn lại số lượng sản phẩm
            if ($request->status == 'cancelled' && $order->status != 'cancelled') {
                foreach ($order->items as $item) {
                    $product = $item->product;
                    $product->stock += $item->quantity;
                    $product->save();
                }
            }

            // Nếu chuyển từ hủy sang trạng thái khác, trừ lại số lượng
            if ($order->status == 'cancelled' && $request->status != 'cancelled') {
                foreach ($order->items as $item) {
                    $product = $item->product;
                    $product->stock -= $item->quantity;
                    $product->save();
                }
            }

            $order->status = $request->status;
            $order->save();

            DB::commit();

            return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function updatePayment(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:unpaid,paid,refunded',
            'payment_method_detail' => 'nullable|string',
            'admin_notes' => 'nullable|string'
        ]);

        $order = Order::findOrFail($id);

        $order->payment_status = $request->payment_status;
        $order->payment_method_detail = $request->payment_method_detail;
        $order->admin_notes = $request->admin_notes;

        if ($request->payment_status == 'paid' && !$order->payment_date) {
            $order->payment_date = now();
            if (!$order->invoice_number) {
                $order->invoice_number = Order::generateInvoiceNumber();
            }
        }

        $order->save();

        return redirect()->back()->with('success', 'Cập nhật thanh toán thành công!');
    }

    public function generateInvoice($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);

        // Tạo số hóa đơn nếu chưa có
        if (!$order->invoice_number) {
            $order->invoice_number = Order::generateInvoiceNumber();
            $order->save();
        }

        return view('admin.orders.invoice', compact('order'));
    }
}
