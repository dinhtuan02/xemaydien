<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'VinFast',
                'slug' => 'vinfast',
                'description' => 'Thương hiệu xe điện nổi bật tại Việt Nam.',
                'is_active' => true,
            ],
            [
                'name' => 'Yadea',
                'slug' => 'yadea',
                'description' => 'Hãng xe điện phổ biến với thiết kế trẻ trung.',
                'is_active' => true,
            ],
            [
                'name' => 'Pega',
                'slug' => 'pega',
                'description' => 'Xe điện phong cách hiện đại, phù hợp người trẻ.',
                'is_active' => true,
            ],
            [
                'name' => 'DK Bike',
                'slug' => 'dk-bike',
                'description' => 'Dòng xe điện giá tốt, phù hợp di chuyển hằng ngày.',
                'is_active' => true,
            ],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(
                ['slug' => $brand['slug']],
                $brand
            );
        }
    }
}
