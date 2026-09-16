<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            ['sequence' => 1, 'code' => '13C', 'description' => 'CHECK BELT TENSION', 'category' => 'mechanical'],
            ['sequence' => 2, 'code' => '16C', 'description' => 'CHECK TORQUE', 'category' => 'mechanical'],
            ['sequence' => 3, 'code' => '18C', 'description' => 'CHECK ALIGNMENT', 'category' => 'mechanical'],
            ['sequence' => 4, 'code' => '1A', 'description' => 'ADD SOME OIL TO LINKAGES', 'category' => 'mechanical'],
            ['sequence' => 5, 'code' => '1B', 'description' => 'CHECK BELT MOVEMENT', 'category' => 'mechanical'],
            ['sequence' => 6, 'code' => '1C', 'description' => 'OIL CHANGE FOR COMPRESSOR', 'category' => 'mechanical'],
            ['sequence' => 7, 'code' => '1D', 'description' => 'MATERIAL CLEANING', 'category' => 'mechanical'],
            ['sequence' => 8, 'code' => '1E', 'description' => 'REPLACE AND RENEW TENSION SCREW GREASE', 'category' => 'mechanical'],
            ['sequence' => 9, 'code' => '1F', 'description' => 'CLEANING FILTER ELEMENT', 'category' => 'mechanical'],
            ['sequence' => 10, 'code' => '1R', 'description' => 'OIL SPRAY', 'category' => 'mechanical'],
        ];

        foreach ($tasks as $task) {
            \App\Models\TaskCatalog::create($task);
        }
    }
}
