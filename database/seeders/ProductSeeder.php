<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Honda Winner X',
                'brand' => 'Honda',
                'model' => 'Winner X',
                'year' => 2024,
                'price' => 45900000,
                'engine_cc' => '150cc',
                'color' => 'Đen - Đỏ',
                'description' => 'Xe côn tay thể thao với động cơ DOHC 150cc, thiết kế thể thao, tiết kiệm nhiên liệu.',
                'image' => 'https://cdn.honda.com.vn/motorbikes/November2023/winner-x-xanh-2023-1-1280x720.jpg',
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yamaha Exciter 155',
                'brand' => 'Yamaha',
                'model' => 'Exciter 155 VVA',
                'year' => 2024,
                'price' => 48900000,
                'engine_cc' => '155cc',
                'color' => 'Xanh - Đen',
                'description' => 'Xe côn tay thể thao với công nghệ VVA, thiết kế thể thao mạnh mẽ.',
                'image' => 'https://cdn.yamaha-motor.com.vn/upload/motorbike/exciter-155-vva-2023/xe-may-yamaha-exciter-155-vva-2023-xanh-1.jpg',
                'stock' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Honda Air Blade',
                'brand' => 'Honda',
                'model' => 'Air Blade',
                'year' => 2024,
                'price' => 42900000,
                'engine_cc' => '125cc',
                'color' => 'Đen - Xám',
                'description' => 'Xe tay ga thể thao bán chạy nhất Việt Nam, động cơ eSP 125cc.',
                'image' => 'https://cdn.honda.com.vn/motorbikes/November2023/airblade-2023-xam-1-1280x720.jpg',
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yamaha NVX 155',
                'brand' => 'Yamaha',
                'model' => 'NVX 155',
                'year' => 2024,
                'price' => 53900000,
                'engine_cc' => '155cc',
                'color' => 'Đen - Xanh',
                'description' => 'Xe tay ga thể thao, động cơ VVA 155cc, thiết kế thể thao.',
                'image' => 'https://cdn.yamaha-motor.com.vn/upload/motorbike/nvx-155-2023/xe-may-yamaha-nvx-155-2023-den-1.jpg',
                'stock' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Honda Vision',
                'brand' => 'Honda',
                'model' => 'Vision',
                'year' => 2024,
                'price' => 38900000,
                'engine_cc' => '110cc',
                'color' => 'Trắng - Hồng',
                'description' => 'Xe tay ga nhỏ gọn, tiết kiệm nhiên liệu, phù hợp với phái nữ.',
                'image' => 'https://cdn.honda.com.vn/motorbikes/November2023/vision-2023-trang-1-1280x720.jpg',
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
