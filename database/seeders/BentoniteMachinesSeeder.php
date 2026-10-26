<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Machine;
use App\Models\Factory;

class BentoniteMachinesSeeder extends Seeder
{
    public function run(): void
    {
        $factory = Factory::where('name', 'GPP')->first();

        if (!$factory) {
            $this->command->error('GPP Factory not found!');
            return;
        }

        $machines = [
            ['serial' => '2.3.1.1.1', 'name' => 'BOX FEEDER صندوق التغذية', 'hours' => 14915, 'type' => 'PREPARATION'],
            ['serial' => '2.3.1.1.2', 'name' => 'PLATE CONVEYOR سير نقل سطحى', 'hours' => 15561, 'type' => 'CRUSHING'],
            ['serial' => '2.3.1.3', 'name' => 'JAW CRUSHER كسارة فكية', 'hours' => 15579, 'type' => 'CRUSHING'],
            ['serial' => '2.3.1.3.1', 'name' => 'GREAS PUMP مضخة الشحم', 'hours' => 15589, 'type' => 'CRUSHING'],
            ['serial' => '2.3.1.4', 'name' => 'BELT CONVEYOR سير ناقل', 'hours' => 15774, 'type' => 'CRUSHING'],
            ['serial' => '2.3.1.5', 'name' => 'DEDUSTING FILTER مصفي غبار', 'hours' => 28362, 'type' => 'CRUSHING'],
            ['serial' => '2.3.1.5.1', 'name' => 'DEDUSTING FAN مروحة سحب الغبار', 'hours' => 28812, 'type' => 'CRUSHING'],
            ['serial' => '2.3.1.5.25', 'name' => 'RADIAL FAN', 'hours' => 20720, 'type' => 'GPP'],
            ['serial' => '2.3.1.5.5', 'name' => 'ROTARY VALVE صمام دوار', 'hours' => 27211, 'type' => 'CRUSHING'],
            ['serial' => '2.3.1.6', 'name' => 'BUCKET ELEVATOR رافع القواديس', 'hours' => 15920, 'type' => 'CRUSHING'],
            ['serial' => '2.3.1.7', 'name' => 'SILOS 90M خزان 90 م3', 'hours' => 28221, 'type' => 'CRUSHING'],
            ['serial' => '2.3.2.1', 'name' => 'TABLE FEEDER طاولة التغذية', 'hours' => 26836, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.2', 'name' => 'MILL الطاحونة', 'hours' => 28755, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.2.0.7', 'name' => 'LUBRICATION SYSTEM نظام التزييت', 'hours' => 28616, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.2.07', 'name' => 'HYDROLIC CABINET صندوق نظام هيدروليك', 'hours' => 28180, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.2.1.1', 'name' => 'MILL GEAR BOX صندوق تروس الطاحونة', 'hours' => 28256, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.3', 'name' => 'CLASSIFIER مصنف المادة', 'hours' => 20358, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.3.A', 'name' => 'CLASSIFIER NEW', 'hours' => 8347, 'type' => 'GPP'],
            ['serial' => '2.3.2.4', 'name' => 'FILTER مصفي', 'hours' => 28914, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.4.5', 'name' => 'FILTER SCREW CONVEYOR ناقل حلزونى', 'hours' => 28029, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.4.7', 'name' => 'ROTARY VALVE الصمام الدوار', 'hours' => 28054, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.5', 'name' => 'RADIAL FAN مروحة محورية', 'hours' => 29109, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.6', 'name' => 'BURNER الفرن', 'hours' => 27661, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.7', 'name' => 'IPAU PUMP مضخة حلزونية', 'hours' => 28518, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.7.3', 'name' => 'ROTARY PISTON COMPERSSORS ضاغط هواء', 'hours' => 28591, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.7.6', 'name' => 'FLOW METER QUANTITY عداد قياس الكمية', 'hours' => 27666, 'type' => 'GRINDING'],
            ['serial' => '2.3.2.9.1', 'name' => 'AIR COMPRESSOR A ضاغط هواء', 'hours' => 22328, 'type' => 'UTIL'],
            ['serial' => '2.3.2.9.2', 'name' => 'AIR COMPRESSOR B ضاغط الهواء B', 'hours' => 26549, 'type' => 'UTIL'],
            ['serial' => '2.3.2.9.3', 'name' => 'AIR COMPRESSOR C ضاغط هواء', 'hours' => 20459, 'type' => 'UTIL'],
            ['serial' => '2.3.2.9.4', 'name' => 'AIR COMPRESSOR D ضاغط الهواء D', 'hours' => 716, 'type' => 'UTIL'],
            ['serial' => '2.3.2.9.5', 'name' => 'AIR DRYER B', 'hours' => 52, 'type' => 'GPP'],
            ['serial' => '2.3.2.9.5.B', 'name' => 'NEW AIR DRYER B', 'hours' => 13560, 'type' => 'GPP'],
            ['serial' => '2.3.2.9.5.D', 'name' => 'AIR DRYER D', 'hours' => 745, 'type' => 'GPP'],
            ['serial' => '2.3.2.9.6.C', 'name' => 'NEW AIR DRYER C', 'hours' => 4075, 'type' => 'GPP'],
            ['serial' => '2.3.2.9.7', 'name' => 'DIESEL PUMP مضخة وقود', 'hours' => 23817, 'type' => 'UTIL'],
            ['serial' => '2.3.2.9.8', 'name' => 'STORGE TANK خزان الوقود', 'hours' => 41984, 'type' => 'UTIL'],
            ['serial' => '2.3.2.9.9', 'name' => 'FAN FOR COMPRESSOR مروحة الضاغط', 'hours' => 43670, 'type' => 'UTIL'],
            ['serial' => '2.3.3.1', 'name' => 'SCREW CONVEYOR ناقل حلزونى', 'hours' => 5485, 'type' => 'PACKING'],
            ['serial' => '2.3.3.2', 'name' => 'BUCKET ELVATOR رافع القواديس', 'hours' => 5892, 'type' => 'PACKING'],
            ['serial' => '2.3.3.3', 'name' => 'NIAGRA SCREEN FEEDER الغربال المغذي', 'hours' => 5867, 'type' => 'PACKING'],
            ['serial' => '2.3.3.4', 'name' => 'PACKING STORGE SILO خزان التعبئة', 'hours' => 5758, 'type' => 'PACKING'],
            ['serial' => '2.3.3.4.3', 'name' => 'ROTARY VALVE FOR PACKING SILO', 'hours' => 7941, 'type' => 'PACKING'],
            ['serial' => '2.3.3.5', 'name' => 'PACKING MACHINE الة التعبئة', 'hours' => 7744, 'type' => 'PACKING'],
            ['serial' => '2.3.3.5.10', 'name' => 'WIRE MESH CONVEYOR الناقل الشبكي', 'hours' => 8161, 'type' => 'PACKING'],
            ['serial' => '2.3.3.5.11', 'name' => 'DOUBLE CLEANING منظف مزدوج', 'hours' => 8145, 'type' => 'PACKING'],
            ['serial' => '2.3.3.5.5', 'name' => 'FLAT BELT CONVEYOR الناقل السطحي', 'hours' => 8187, 'type' => 'PACKING'],
            ['serial' => '2.3.3.5.7', 'name' => 'SCREW CONVEYOR', 'hours' => 8181, 'type' => 'PACKING'],
            ['serial' => '2.3.3.6', 'name' => 'PACKING FILTER مصفي التعبئة', 'hours' => 8260, 'type' => 'PACKING'],
            ['serial' => '2.3.3.6.25', 'name' => 'RADIAL FAN', 'hours' => 8344, 'type' => 'PACKING'],
            ['serial' => '2.3.3.6.5', 'name' => 'FILTER SCREW CONVEYOR مصفى الناقل', 'hours' => 8306, 'type' => 'PACKING'],
            ['serial' => '2.3.3.6.7', 'name' => 'ROTARY VALVE صمام دوار', 'hours' => 8212, 'type' => 'PACKING'],
            ['serial' => '2.3.3.8', 'name' => 'EMPTY BAG LIFT رافعة الاكياس الفارغة', 'hours' => 3467, 'type' => 'UTILITIY'],
            ['serial' => '2.4.1.1.2', 'name' => 'SILO 500M3 NO(2)', 'hours' => 33524, 'type' => 'SILO(2)'],
            ['serial' => '2.4.1.1.3', 'name' => 'SILO 500M3 NO(3)', 'hours' => 18022, 'type' => 'SILO(3)'],
            ['serial' => '2.4.1.1.4', 'name' => 'SILO 500M3 NO(4)', 'hours' => 9699, 'type' => 'SILO 500M3 (4)'],
            ['serial' => '2.4.1.3.19', 'name' => 'LOADING MACHINE الة التحميل', 'hours' => 258, 'type' => 'SILO'],
            ['serial' => '2.4.1.3.2', 'name' => 'BUCKET WHEEL FEEDER FOR SILO (2)', 'hours' => 14416, 'type' => 'SILO(2)'],
            ['serial' => '2.4.1.3.3', 'name' => 'BUCKET WHEEL FEEDER FOR SILO (3)', 'hours' => 5852, 'type' => 'SILO(3)'],
            ['serial' => '2.4.1.3.4', 'name' => 'BUCKET WHEEL FEEDER FOR SILO (4)', 'hours' => 4441, 'type' => 'SILO(4)'],
            ['serial' => '2.4.1.4.2', 'name' => 'DEDUSTING FILTER FOR SILO NO(2)', 'hours' => 22251, 'type' => 'SILO NO(2)'],
            ['serial' => '2.4.1.4.25.2', 'name' => 'DEDUSTING FAN FOR SILO NO(2)', 'hours' => 21959, 'type' => 'SILO'],
            ['serial' => '2.4.1.4.25.3', 'name' => 'DEDUSTING FAN FOR SILO NO(3)', 'hours' => 12956, 'type' => 'SILO(3)'],
            ['serial' => '2.4.1.4.25.4', 'name' => 'DEDUSTING FAN FOR SILO NO (4)', 'hours' => 7327, 'type' => 'SILO (4)'],
            ['serial' => '2.4.1.4.3', 'name' => 'DEDUSTING FILTER FOR SILO NO (3)', 'hours' => 12934, 'type' => 'SILO NO (3)'],
            ['serial' => '2.4.1.4.4', 'name' => 'DEDUSTING FILTER FOR SILO (4)', 'hours' => 7267, 'type' => 'SILO NO(4)'],
            ['serial' => '2.5.1.1.2', 'name' => 'ROLLERS CONVEYOR', 'hours' => 7297, 'type' => 'PALATIZING'],
            ['serial' => '2.OP2', 'name' => 'BARITE OPERATION PANEL لوحة التشغيل', 'hours' => 34120, 'type' => 'CONTROL ROOM'],
            ['serial' => '2.OP4', 'name' => 'PACKING PANEL', 'hours' => 10926, 'type' => 'GPP'],
            ['serial' => '2.W136', 'name' => 'RAW MATERIAL WEIGHT', 'hours' => 14427, 'type' => 'GPP'],
            ['serial' => '2.W137', 'name' => 'PORTABLE WEIGHT SCALE S/NO 49867', 'hours' => 0, 'type' => 'GPP'],
            ['serial' => '2.W142', 'name' => 'PORTABALE WEIGHT SCALE S/NO 30073', 'hours' => 0, 'type' => 'GPP'],
            ['serial' => 'VC-500', 'name' => 'VACUUM CLEANER', 'hours' => 0, 'type' => 'GPP'],
        ];

        foreach ($machines as $item) {
            Machine::updateOrCreate(
                ['serial_number' => $item['serial']],
                [
                    'factory_id' => $factory->id,
                    'production_line' => 'خط البينتونايت', // Putting it in Bentonite as requested by user
                    'name' => $item['name'],
                    'type' => $item['type'],
                    'total_operating_hours' => $item['hours'],
                    'status' => 'active',
                ]
            );
        }
    }
}
