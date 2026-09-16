<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factories = [
            ['name' => 'LPP', 'location' => 'مجمع شركة الجوف - المصنع الأول'],
            ['name' => 'GPP', 'location' => 'مجمع شركة الجوف - المصنع الثاني'],
        ];

        foreach ($factories as $factory) {
            \App\Models\Factory::updateOrCreate(
                ['name' => $factory['name']],
                $factory
            );
        }
    }
}
