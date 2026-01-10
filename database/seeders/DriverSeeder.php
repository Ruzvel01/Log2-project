<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Driver;

class DriverSeeder extends Seeder
{
    public function run(): void
    {
        $drivers = [
            [
                'name' => 'Juan Dela Cruz',
                'license_no' => 'DL-2024-0001',
                'contact_no' => '09123456789',
                'status' => 'Available',
            ],
            [
                'name' => 'Pedro Santos',
                'license_no' => 'DL-2024-0002',
                'contact_no' => '09987654321',
                'status' => 'Available',
            ],
            [
                'name' => 'Maria Clara',
                'license_no' => 'DL-2024-0003',
                'contact_no' => '09091234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Jose Rizal',
                'license_no' => 'DL-2024-0004',
                'contact_no' => '09181234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Andres Bonifacio',
                'license_no' => 'DL-2024-0005',
                'contact_no' => '09271234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Emilio Aguinaldo',
                'license_no' => 'DL-2024-0006',
                'contact_no' => '09391234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Apolinario Mabini',
                'license_no' => 'DL-2024-0007',
                'contact_no' => '09451234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Antonio Luna',
                'license_no' => 'DL-2024-0008',
                'contact_no' => '09561234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Gregorio del Pilar',
                'license_no' => 'DL-2024-0009',
                'contact_no' => '09671234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Marcelo H. del Pilar',
                'license_no' => 'DL-2024-0010',
                'contact_no' => '09771234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Manuel Quezon',
                'license_no' => 'DL-2024-0011',
                'contact_no' => '09171234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Sergio Osmeña',
                'license_no' => 'DL-2024-0012',
                'contact_no' => '09281234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Ramon Magsaysay',
                'license_no' => 'DL-2024-0013',
                'contact_no' => '09381234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Diosdado Macapagal',
                'license_no' => 'DL-2024-0014',
                'contact_no' => '09481234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Ferdinand Marcos',
                'license_no' => 'DL-2024-0015',
                'contact_no' => '09581234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Corazon Aquino',
                'license_no' => 'DL-2024-0016',
                'contact_no' => '09681234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Benigno Aquino Jr.',
                'license_no' => 'DL-2024-0017',
                'contact_no' => '09781234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Gloria Arroyo',
                'license_no' => 'DL-2024-0018',
                'contact_no' => '09191234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Rodrigo Duterte',
                'license_no' => 'DL-2024-0019',
                'contact_no' => '09291234567',
                'status' => 'Available',
            ],
            [
                'name' => 'Leni Robredo',
                'license_no' => 'DL-2024-0020',
                'contact_no' => '09391239876',
                'status' => 'Available',
            ],
            [
                'name' => 'Isko Moreno',
                'license_no' => 'DL-2024-0021',
                'contact_no' => '09491239876',
                'status' => 'Available',
            ],
            [
                'name' => 'Manny Pacquiao',
                'license_no' => 'DL-2024-0022',
                'contact_no' => '09591239876',
                'status' => 'Available',
            ],
            [
                'name' => 'Sarah Duterte',
                'license_no' => 'DL-2024-0023',
                'contact_no' => '09691239876',
                'status' => 'Available',
            ],
            [
                'name' => 'Bongbong Marcos',
                'license_no' => 'DL-2024-0024',
                'contact_no' => '09791239876',
                'status' => 'Available',
            ],
            [
                'name' => 'Alan Peter Cayetano',
                'license_no' => 'DL-2024-0025',
                'contact_no' => '09101239876',
                'status' => 'Available',
            ],
        ];

        foreach ($drivers as $driver) {
            Driver::create($driver);
        }
    }
}
