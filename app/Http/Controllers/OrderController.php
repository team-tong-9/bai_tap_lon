<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Auth::user()->orders()->orderBy('id', 'desc')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        if ($order->user_id != Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function checkout()
    {
        $cart = Auth::user()->cart;

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $user = Auth::user();
        return view('orders.checkout', compact('cart', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|in:cod,bank_transfer',
            'notes' => 'nullable|string'
        ]);

        $cart = Auth::user()->cart;

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $cart->total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'unpaid',
                'shipping_address' => $request->shipping_address,
                'phone' => $request->phone,
                'notes' => $request->notes
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->product->price * $item->quantity
                ]);

                $product = $item->product;
                $product->stock -= $item->quantity;
                $product->save();
            }

            $cart->items()->delete();

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                           ->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id != Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        if ($order->status != 'pending') {
            return back()->with('error', 'Không thể hủy đơn hàng này!');
        }

        $order->status = 'cancelled';
        $order->save();

        foreach ($order->items as $item) {
            $product = $item->product;
            $product->stock += $item->quantity;
            $product->save();
        }

        return back()->with('success', 'Đã hủy đơn hàng!');
    }
}
