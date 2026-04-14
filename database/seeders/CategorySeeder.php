<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Xe máy điện học sinh',
                'slug' => 'xe-may-dien-hoc-sinh',
                'description' => 'Dòng xe nhỏ gọn, tiết kiệm điện, phù hợp học sinh.',
                'is_active' => true,
            ],
            [
                'name' => 'Xe máy điện cao cấp',
                'slug' => 'xe-may-dien-cao-cap',
                'description' => 'Thiết kế hiện đại, công nghệ cao, động cơ mạnh.',
                'is_active' => true,
            ],
            [
                'name' => 'Xe máy điện đô thị',
                'slug' => 'xe-may-dien-do-thi',
                'description' => 'Phù hợp di chuyển hàng ngày trong thành phố.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
