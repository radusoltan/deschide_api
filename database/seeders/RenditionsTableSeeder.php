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
                'aspect' => 1.818181818181818,
                'coords' => json_encode([])
            ],
            [
                'name' => 'mobileMain',
                'width' => 1000,
                'height' => 777,
                'aspect' => 1.28,
                'coords' => json_encode([])
            ]
        ];

        foreach ($renditions as $rendition){

            Rendition::create($rendition);

        }
    }
}
