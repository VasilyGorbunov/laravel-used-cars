<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::factory()
            ->for(Brand::factory()->state(['name' => 'Toyota'])
            )
            ->state([
                'model' => 'Corolla',
                'year' => '2017',
                'price' => 10_000,
                'images' => [
                    'corolla1.jpg',
                    'corolla2.jpg',
                    'corolla3.jpg',
                ]
            ])
            ->create();
        Car::factory()
            ->for(Brand::factory()->state(['name' => 'Nissan'])
            )
            ->state([
                'model' => 'Qashqai',
                'year' => '2019',
                'price' => 14_700,
                'images' => [
                    'qashqai1.jpg',
                    'qashqai2.jpg',
                    'qashqai3.jpg',
                ]
            ])
            ->create();
        Car::factory(2)
            ->for(Brand::factory()->state(['name' => 'Lada'])
            )
            ->state(new Sequence(
                    [
                        'model' => 'Vesta',
                        'year' => '2022',
                        'price' => 9_100,
                        'images' => [
                            'vesta1.jpg',
                            'vesta2.jpg',
                            'vesta3.jpg',
                        ]
                    ],
                    [
                        'model' => 'XRAY',
                        'year' => '2024',
                        'price' => 39_100,
                        'images' => [
                            'xray1.jpg',
                            'xray2.jpg',
                            'xray3.jpg',
                        ]
                    ],
                )
            )
            ->create();

    }
}
