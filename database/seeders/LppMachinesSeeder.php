<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Machine;
use App\Models\Factory;

class LppMachinesSeeder extends Seeder
{
    public function run(): void
    {
        $factory = Factory::where('name', 'LPP')->first();

        if (!$factory) {
            $this->command->error('LPP Factory not found!');
            return;
        }

        $machines = [
            ['serial' => '3.A110', 'name' => 'AGITATOR-PV 101', 'hours' => 19884, 'type' => 'PROCESS AREA'],
            ['serial' => '3.A111', 'name' => 'AGITATOR-PV 102', 'hours' => 14674, 'type' => 'PROCESS AREA'],
            ['serial' => '3.A112', 'name' => 'AGITATOR-PV 103', 'hours' => 14914, 'type' => 'PROCESS AREA'],
            ['serial' => '3.A113', 'name' => 'AGITATOR-PV 113', 'hours' => 20792, 'type' => 'PROCESS AREA'],
            ['serial' => '3.A114', 'name' => 'AGITATOR-PV 114', 'hours' => 21815, 'type' => 'PROCESS AREA'],
            ['serial' => '3.A186', 'name' => 'AGITATOR-T185', 'hours' => 586, 'type' => 'LPP'],
            ['serial' => '3.A187', 'name' => 'AGITATOR-T185', 'hours' => 762, 'type' => 'LPP PLANT'],
            ['serial' => '3.C151', 'name' => 'COMPRESSOR', 'hours' => 41470, 'type' => 'LPP PLANT'],
            ['serial' => '3.C151/1', 'name' => 'COMPRESSOR', 'hours' => 21722, 'type' => 'UTILITY AREA'],
            ['serial' => '3.C151/2', 'name' => 'AIR DRYER', 'hours' => 35431, 'type' => 'UTILITY AREA'],
            ['serial' => '3.CC1', 'name' => 'CONTROL VALVE CV025', 'hours' => 487, 'type' => 'LPP PLANT'],
            ['serial' => '3.CC2', 'name' => 'CONTROL ROOM', 'hours' => 45366, 'type' => 'LPP PLANT'],
            ['serial' => '3.CV001', 'name' => 'CONTROL VALVE', 'hours' => 26519, 'type' => 'LPP'],
            ['serial' => '3.CV002', 'name' => 'CONTROL VALVE', 'hours' => 13932, 'type' => 'PV102'],
            ['serial' => '3.CV003', 'name' => 'CONTROL VALVE', 'hours' => 6279, 'type' => 'PV102'],
            ['serial' => '3.CV004', 'name' => 'CONTROL VALVE', 'hours' => 8113, 'type' => 'PV101'],
            ['serial' => '3.CV005', 'name' => 'CONTROL VALVE', 'hours' => 8193, 'type' => 'PV101'],
            ['serial' => '3.CV006', 'name' => 'CONTROL VALVE', 'hours' => 12403, 'type' => 'PV113'],
            ['serial' => '3.CV007', 'name' => 'CONTROL VALVE', 'hours' => 12141, 'type' => 'PV113'],
            ['serial' => '3.CV008', 'name' => 'CONTROL VALVE', 'hours' => 16443, 'type' => 'PV114'],
            ['serial' => '3.CV009', 'name' => 'CONTROL VALVE', 'hours' => 8348, 'type' => 'PV114'],
            ['serial' => '3.CV010', 'name' => 'CONTROL VALVE', 'hours' => 7750, 'type' => 'PV103'],
            ['serial' => '3.CV015', 'name' => 'CONTROL VALVE', 'hours' => 8117, 'type' => 'PV103'],
            ['serial' => '3.CV016', 'name' => 'CONTROL VALVE', 'hours' => 6271, 'type' => 'PV102'],
            ['serial' => '3.CV017', 'name' => 'CONTROL VALVE', 'hours' => 6183, 'type' => 'PV102'],
            ['serial' => '3.CV018', 'name' => 'CONTROL VALVE', 'hours' => 7979, 'type' => 'PV101'],
            ['serial' => '3.CV019', 'name' => 'CONTROL VALVE', 'hours' => 8054, 'type' => 'PV101'],
            ['serial' => '3.CV020', 'name' => 'CONTROL VALVE', 'hours' => 19668, 'type' => 'PV113'],
            ['serial' => '3.CV021', 'name' => 'CONTROL VALVE', 'hours' => 18384, 'type' => 'PV113'],
            ['serial' => '3.CV022', 'name' => 'CONTROL VALVE', 'hours' => 13788, 'type' => 'PV114'],
            ['serial' => '3.CV023', 'name' => 'CONTROL VALVE', 'hours' => 13854, 'type' => 'PV114'],
            ['serial' => '3.CV024', 'name' => 'CONTROL VALVE', 'hours' => 13426, 'type' => 'PV103'],
            ['serial' => '3.CV026', 'name' => 'CONTROL VALVE', 'hours' => 11321, 'type' => 'LPP PLANT'],
            ['serial' => '3.H105', 'name' => 'HOT OIL HEATER', 'hours' => 6294, 'type' => 'LPP PLANT'],
            ['serial' => '3.H106', 'name' => 'S.S.CONDENSERS/ PV101', 'hours' => 40128, 'type' => 'LPP PLANT'],
            ['serial' => '3.H142', 'name' => 'S.S.CONDENSERS/ PV102', 'hours' => 43067, 'type' => 'LPP PLANT'],
            ['serial' => '3.H143', 'name' => 'COLD OIL AIR COOLERS( FIN FANS)', 'hours' => 1719, 'type' => 'LPP PLANT'],
            ['serial' => '3.H144', 'name' => 'S.S.CONDENSER/PV103', 'hours' => 5728, 'type' => 'LPP PLANT'],
            ['serial' => '3.H156', 'name' => 'CHILLER', 'hours' => 36589, 'type' => 'LPP PLANT'],
            ['serial' => '3.H166', 'name' => 'COLD OIL AIR COOLERS( FIN FANS)', 'hours' => 34558, 'type' => 'LPP PLANT'],
            ['serial' => '3.H168', 'name' => 'GRAPH CONDENSER PV103', 'hours' => 8410, 'type' => 'LPP PLANT'],
            ['serial' => '3.H188', 'name' => 'HOT ROOM', 'hours' => 9619, 'type' => 'LPP PLANT'],
            ['serial' => '3.H189', 'name' => 'DRUM HEATER', 'hours' => 12099, 'type' => 'LPP PLANT'],
            ['serial' => '3.H189A', 'name' => 'LIGHTING', 'hours' => 42115, 'type' => 'LPP PLANT'],
            ['serial' => '3.I&E.L.', 'name' => 'EL.POWER DISTR.ROOM', 'hours' => 36434, 'type' => 'LPP PLANT'],
            ['serial' => '3.MCC', 'name' => 'NITROGEN SYSTEM', 'hours' => 204, 'type' => 'LPP'],
            ['serial' => '3.NC', 'name' => 'PROCESS PUMPS,P.P.BUILDING PV101', 'hours' => 1948, 'type' => 'LPP PLANT'],
            ['serial' => '3.P117', 'name' => 'P.DIAPHRAGM PUMP:PV 103', 'hours' => 1971, 'type' => 'LPP PLANT'],
            ['serial' => '3.P118', 'name' => 'PROCESS PUMPS,P.PUMPS-P.BUILDING', 'hours' => 2150, 'type' => 'LPP PLANT'],
            ['serial' => '3.P119', 'name' => 'PROCESS PUMPS,P.PUMPS-P.BUILDING', 'hours' => 2207, 'type' => 'LPP PLANT'],
            ['serial' => '3.P120', 'name' => 'PROCESS PUMPS,P.PUMPS-P.BUILDING', 'hours' => 312, 'type' => 'LPP PLANT'],
            ['serial' => '3.P121', 'name' => 'VACUUM PUMP', 'hours' => 482, 'type' => 'LPP PLANT'],
            ['serial' => '3.P122A', 'name' => 'P.PUMP T.FARM', 'hours' => 1566, 'type' => 'LPP PLANT'],
            ['serial' => '3.P122', 'name' => 'PROCESS WATER PUMPS', 'hours' => 211, 'type' => 'LPP PLANT'],
            ['serial' => '3.P127', 'name' => 'P.DIAPHRAGH PUMPS-REACTOR PUMP', 'hours' => 67, 'type' => 'LPP PLANT'],
            ['serial' => '3.P128', 'name' => 'P.PUMPS-T.FARM', 'hours' => 443, 'type' => 'LPP PLANT'],
            ['serial' => '3.P129', 'name' => 'P.DIAPHRAGH PUMPS-DRUM PUMP PV101', 'hours' => 2549, 'type' => 'LPP PLANT'],
            ['serial' => '3.P130', 'name' => 'P.DIAPHRAGH PUMPS-DRUM PUMP PV102', 'hours' => 3404, 'type' => 'LPP'],
            ['serial' => '3.P131', 'name' => 'HOT OIL CIRC.PUMPS', 'hours' => 28035, 'type' => 'LPP PLANT'],
            ['serial' => '3.P132', 'name' => 'DIESEL PUMP', 'hours' => 19397, 'type' => 'LPP PLANT'],
            ['serial' => '3.P143', 'name' => 'HOT OIL CIRC.PUMPS', 'hours' => 41507, 'type' => 'LPP PLANT'],
            ['serial' => '3.P144', 'name' => 'COLD OIL CIRC.PUMPS', 'hours' => 40920, 'type' => 'LPP PLANT'],
            ['serial' => '3.P145', 'name' => 'COLD OIL CIRC.PUMPS', 'hours' => 655, 'type' => 'LPP PLANT'],
            ['serial' => '3.P146', 'name' => 'PROCESS WATER PUMPS', 'hours' => 643, 'type' => 'LPP PLANT'],
            ['serial' => '3.P157', 'name' => 'SUMP PUMPS (EFFLUENT PUMP)', 'hours' => 968, 'type' => 'LPP PLANT'],
            ['serial' => '3.P158', 'name' => 'SUMP PUMPS (EFFLUENT PUMP)', 'hours' => 50, 'type' => 'LPP PLANT'],
            ['serial' => '3.P159', 'name' => 'P.PUMPS-T.FARM', 'hours' => 56, 'type' => 'LPP PLANT'],
            ['serial' => '3.P160', 'name' => 'P.PUMPS-T.FARM', 'hours' => 175, 'type' => 'LPP PLANT'],
            ['serial' => '3.P161', 'name' => 'P.PUMPS-T.FARM', 'hours' => 178, 'type' => 'LPP PLANT'],
            ['serial' => '3.P162', 'name' => 'P.PUMPS-T.FARM', 'hours' => 389, 'type' => 'LPP PLANT'],
            ['serial' => '3.P163', 'name' => 'H.OIL RECIRC.PUMP:PV 103', 'hours' => 10801, 'type' => 'LPP PLANT'],
            ['serial' => '3.P165', 'name' => 'T.FARM OIL RECIRC.PUMP', 'hours' => 1923, 'type' => 'LPP PLANT'],
            ['serial' => '3.P167', 'name' => 'P.DIAPHRAGH PUMPS-DRUM PUMP PV103', 'hours' => 870, 'type' => 'LPP'],
            ['serial' => '3.P227', 'name' => 'HEAT OIL GHARGE PUMP', 'hours' => 4580, 'type' => 'LPP'],
            ['serial' => '3.P237', 'name' => 'P.DIAPHRAGH PUMPS-DRUM PUMP PV113', 'hours' => 10443, 'type' => 'LPP'],
            ['serial' => '3.P243', 'name' => 'P.DIAPHRAGH PUMPS-DRUM PUMP PV114', 'hours' => 4982, 'type' => 'LPP'],
            ['serial' => '3.P244', 'name' => 'LIGHTNING PROTECTION', 'hours' => 10691, 'type' => 'LPP PLANT'],
            ['serial' => '3.P244A', 'name' => 'S.S REACTORS', 'hours' => 14440, 'type' => 'LPP PLANT'],
            ['serial' => '3.PL', 'name' => 'S.S.REACTORS', 'hours' => 10415, 'type' => 'LPP PLANT'],
            ['serial' => '3.PV101', 'name' => 'GLASS LINED REACTOR', 'hours' => 11672, 'type' => 'LPP PLANT'],
            ['serial' => '3.PV102', 'name' => 'S.S.RECEIVER FOR PV101', 'hours' => 7977, 'type' => 'LPP PLANT'],
            ['serial' => '3.PV103', 'name' => 'S.S.RECEIVER FOR PV102', 'hours' => 9720, 'type' => 'LPP PLANT'],
        ];

        foreach ($machines as $item) {
            Machine::updateOrCreate(
                ['serial_number' => $item['serial']],
                [
                    'factory_id' => $factory->id,
                    'production_line' => null, // LPP has no specific lines requested
                    'name' => $item['name'],
                    'type' => $item['type'],
                    'total_operating_hours' => $item['hours'],
                    'status' => 'active',
                ]
            );
        }
    }
}
