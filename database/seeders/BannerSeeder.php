<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Xe máy điện hiện đại - ưu đãi lớn',
                'image' => 'assets/images/banners/banner-1.jpg',
                'link' => '/products',
                'position' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Bộ sưu tập xe điện mới nhất',
                'image' => 'assets/images/banners/banner-2.jpg',
                'link' => '/products?sort=newest',
                'position' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(
                ['title' => $banner['title']],
                $banner
            );
        }
    }
}
