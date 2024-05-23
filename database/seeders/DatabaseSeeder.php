<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory([
            'email' => 'admin@app.com',
        ])->create();

        Brand::factory(['name' => 'Honda'])->create();

        $this->call([
            CarSeeder::class,
        ]);
    }
}
