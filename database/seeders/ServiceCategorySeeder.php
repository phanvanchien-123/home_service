<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service_categories')->insert([
            [
                'name'=>'Điều hòa',
                'slug'=>'dieu-hoa',
                'image'=>'1521969345.png'
            ],
            [
                'name'=>'Làm Đẹp',
                'slug'=>'lam-dep',
                'image'=>'1521969358.png'
            ],
            [
                'name'=>'Nước',
                'slug'=>'nuoc',
                'image'=>'1521969409.png'
            ],
            [
                'name'=>'Sửa Chữa',
                'slug'=>'sua-chua',
                'image'=>'1521969419.png'
            ],
            [
                'name'=>'Vòi Nước',
                'slug'=>'voi-nuoc',
                'image'=>'1521969430.png'
            ],
            [
                'name'=>'Hút Bụi',
                'slug'=>'hut-bui',
                'image'=>'1521969446.png'
            ],
            [
                'name'=>'Cắt',
                'slug'=>'cat',
                'image'=>'1521969454.png'
            ],
            [
                'name'=>'Diệt côn trùng',
                'slug'=>'diet-con-trung',
                'image'=>'1521969464.png'
            ],
            [
                'name'=>'Khử Mùi',
                'slug'=>'khu-mui',
                'image'=>'1521969490.png'
            ],
            [
                'name'=>'Sửa máy tính',
                'slug'=>'sua-may-tính',
                'image'=>'1521969512.png'
            ],

        ]);
    }
}
