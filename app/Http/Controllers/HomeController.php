<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::latest()->take(4)->get();
        return view('home', compact('featuredProducts'));
    }

    public function profile()
    {
        $user = auth()->user();

        if ($user) {
            $personalInfo = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? 'Chưa cập nhật',
                'address' => $user->address ?? 'Chưa cập nhật',
                'avatar' => 'https://ui-avatars.com/api/?background=e74c3c&color=fff&size=200&name=' . urlencode($user->name),
            ];
        } else {
            $personalInfo = [
                'name' => 'Khách hàng',
                'email' => 'guest@example.com',
                'phone' => 'Chưa cập nhật',
                'address' => 'Chưa cập nhật',
                'avatar' => 'https://ui-avatars.com/api/?background=e74c3c&color=fff&size=200&name=Guest',
            ];
        }

        return view('profile', compact('personalInfo'));
    }
}
