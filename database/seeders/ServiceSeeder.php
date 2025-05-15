<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Ganti Oli',
                'estimasi' => 60
            ],
            [
                'name' => 'Service Ringan',
                'estimasi' => 120
            ],
            [
                'name' => 'Tune Up',
                'estimasi' => 180
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
