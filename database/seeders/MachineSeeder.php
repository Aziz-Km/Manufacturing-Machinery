<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Factory;
use App\Models\Machine;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $processArea = Factory::create(['name' => 'PROCESS AREA']);
        $lppPlant = Factory::create(['name' => 'LPP PLANT']);
        $utilityArea = Factory::create(['name' => 'UTILITY AREA']);
        $pv101 = Factory::create(['name' => 'PV101']);
        $pv102 = Factory::create(['name' => 'PV102']);
        $pv103 = Factory::create(['name' => 'PV103']);

        $machines = [
            ['serial_number' => '3.A110', 'name' => 'AGITATOR-PV 101', 'total_operating_hours' => 19884, 'factory_id' => $processArea->id],
            ['serial_number' => '3.A111', 'name' => 'AGITATOR-PV 102', 'total_operating_hours' => 14676, 'factory_id' => $processArea->id],
            ['serial_number' => '3.A112', 'name' => 'AGITATOR-PV 103', 'total_operating_hours' => 16914, 'factory_id' => $processArea->id],
            ['serial_number' => '3.A186', 'name' => 'AGITATOR-T183', 'total_operating_hours' => 762, 'factory_id' => $lppPlant->id],
            ['serial_number' => '3.C151/1', 'name' => 'COMPRESSOR', 'total_operating_hours' => 35431, 'factory_id' => $utilityArea->id],
            ['serial_number' => '3.CC1', 'name' => 'CONTROL VALVE CV025', 'total_operating_hours' => 487, 'factory_id' => $lppPlant->id],
            ['serial_number' => '3.CV001', 'name' => 'CONTROL VALVE', 'total_operating_hours' => 26519, 'factory_id' => $pv103->id],
            ['serial_number' => '3.H140', 'name' => 'COLD OIL AIR COOLERS', 'total_operating_hours' => 43067, 'factory_id' => $lppPlant->id],
            ['serial_number' => '3.MCC', 'name' => 'EL.POWER DISTR.ROOM', 'total_operating_hours' => 42115, 'factory_id' => $lppPlant->id],
            ['serial_number' => '3.PV101', 'name' => 'S.S.REACTORS', 'total_operating_hours' => 10891, 'factory_id' => $lppPlant->id],
        ];

        foreach ($machines as $machine) {
            Machine::create($machine);
        }
    }
}
