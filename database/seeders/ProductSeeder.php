<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryStudent = Category::where('slug', 'xe-may-dien-hoc-sinh')->first();
        $categoryPremium = Category::where('slug', 'xe-may-dien-cao-cap')->first();
        $categoryUrban = Category::where('slug', 'xe-may-dien-do-thi')->first();

        $vinfast = Brand::where('slug', 'vinfast')->first();
        $yadea = Brand::where('slug', 'yadea')->first();
        $pega = Brand::where('slug', 'pega')->first();
        $dkbike = Brand::where('slug', 'dk-bike')->first();

        $products = [
            [
                'category_id' => $categoryUrban?->id,
                'brand_id' => $vinfast?->id,
                'name' => 'VinFast Evo 200',
                'slug' => 'vinfast-evo-200',
                'price' => 22000000,
                'sale_price' => 20990000,
                'quantity' => 15,
                'color' => 'Đỏ',
                'max_speed' => 70,
                'range_per_charge' => 203,
                'battery_capacity' => 3500,
                'charging_time' => 360,
                'thumbnail' => 'assets/images/products/vinfast-evo-200.jpg',
                'short_description' => 'Xe máy điện đô thị hiện đại, tiết kiệm và mạnh mẽ.',
                'description' => 'VinFast Evo 200 là mẫu xe máy điện phù hợp cho nhu cầu di chuyển hằng ngày, kiểu dáng trẻ trung, cốp rộng và vận hành êm ái.',
                'specifications' => json_encode([
                    'Động cơ' => 'Inhub',
                    'Pin/Ắc quy' => 'Pin LFP',
                    'Tốc độ tối đa' => '70 km/h',
                    'Quãng đường' => '203 km/lần sạc',
                ], JSON_UNESCAPED_UNICODE),
                'sold_count' => 25,
                'is_featured' => true,
                'is_new' => true,
                'is_sale' => true,
                'is_active' => true,
                'images' => [
                    'assets/images/products/vinfast-evo-200.jpg',
                    'assets/images/products/vinfast-evo-200-2.jpg',
                ],
            ],
            [
                'category_id' => $categoryPremium?->id,
                'brand_id' => $yadea?->id,
                'name' => 'Yadea Oris',
                'slug' => 'yadea-oris',
                'price' => 23900000,
                'sale_price' => 22900000,
                'quantity' => 12,
                'color' => 'Trắng',
                'max_speed' => 65,
                'range_per_charge' => 90,
                'battery_capacity' => 2400,
                'charging_time' => 420,
                'thumbnail' => 'assets/images/products/yadea-oris.jpg',
                'short_description' => 'Thiết kế sang trọng, vận hành ổn định.',
                'description' => 'Yadea Oris nổi bật với kiểu dáng thanh lịch, đèn LED hiện đại và hệ thống phanh an toàn.',
                'specifications' => [
                    'Động cơ' => '1000W',
                    'Ắc quy' => 'Graphene',
                    'Tốc độ tối đa' => '65 km/h',
                    'Quãng đường' => '90 km/lần sạc',
                ],
                'sold_count' => 18,
                'is_featured' => true,
                'is_new' => true,
                'is_sale' => true,
                'is_active' => true,
                'images' => [
                    'assets/images/products/yadea-oris.jpg',
                    'assets/images/products/yadea-oris-2.jpg',
                ],
            ],
            [
                'category_id' => $categoryStudent?->id,
                'brand_id' => $pega?->id,
                'name' => 'Pega Aura S',
                'slug' => 'pega-aura-s',
                'price' => 18500000,
                'sale_price' => null,
                'quantity' => 20,
                'color' => 'Xanh',
                'max_speed' => 50,
                'range_per_charge' => 100,
                'battery_capacity' => 2200,
                'charging_time' => 480,
                'thumbnail' => 'assets/images/products/pega-aura-s.jpg',
                'short_description' => 'Mẫu xe nhỏ gọn dành cho học sinh, sinh viên.',
                'description' => 'Pega Aura S có thiết kế thân thiện, dễ lái, tiết kiệm điện và phù hợp nhu cầu đi học hằng ngày.',
                'specifications' => [
                    'Động cơ' => '800W',
                    'Ắc quy' => '4 bình',
                    'Tốc độ tối đa' => '50 km/h',
                    'Quãng đường' => '100 km/lần sạc',
                ],
                'sold_count' => 30,
                'is_featured' => false,
                'is_new' => true,
                'is_sale' => false,
                'is_active' => true,
                'images' => [
                    'assets/images/products/pega-aura-s.jpg',
                ],
            ],
            [
                'category_id' => $categoryUrban?->id,
                'brand_id' => $dkbike?->id,
                'name' => 'DK Roma SX',
                'slug' => 'dk-roma-sx',
                'price' => 17200000,
                'sale_price' => 16500000,
                'quantity' => 10,
                'color' => 'Đen',
                'max_speed' => 48,
                'range_per_charge' => 85,
                'battery_capacity' => 2000,
                'charging_time' => 420,
                'thumbnail' => 'assets/images/products/dk-roma-sx.jpg',
                'short_description' => 'Xe điện giá tốt, thiết kế thanh lịch.',
                'description' => 'DK Roma SX hướng tới người dùng cần phương tiện gọn nhẹ, đẹp mắt, dễ sử dụng trong đô thị.',
                'specifications' => [
                    'Động cơ' => '800W',
                    'Ắc quy' => '4 bình 20Ah',
                    'Tốc độ tối đa' => '48 km/h',
                    'Quãng đường' => '85 km/lần sạc',
                ],
                'sold_count' => 14,
                'is_featured' => false,
                'is_new' => false,
                'is_sale' => true,
                'is_active' => true,
                'images' => [
                    'assets/images/products/dk-roma-sx.jpg',
                ],
            ],
        ];

        foreach ($products as $item) {
            $images = $item['images'];
            unset($item['images']);

            $product = Product::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );

            foreach ($images as $index => $image) {
                ProductImage::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'image' => $image,
                    ],
                    [
                        'is_primary' => $index === 0,
                    ]
                );
            }
        }
    }
}
