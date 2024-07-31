<?php

namespace Database\Seeders;

use App\Models\Rendition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RenditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $renditions = [
            [
                'name' => 'main',
                'width' => 1000,
                'height' => 550,
                'aspect' => 1.818181818181818
            ],
            [
                'name' => 'mobileMain',
                'width' => 1000,
                'height' => 777,
                'aspect' => 1.28
            ],
            [
                'name' => 'openGraph',
                'width' => 1200,
                'height' => 630,
                'aspect' => 1.9047619047619
            ],
//            [
//                'name' => 'video',
//                'width' => 425,
//                'height' => 500,
//                'aspect' => .85
//            ]
        ];

        foreach ($renditions as $rendition){

            Rendition::create($rendition);

        }
    }
}
