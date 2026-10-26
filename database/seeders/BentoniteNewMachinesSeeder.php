<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Machine;
use App\Models\Factory;

class BentoniteNewMachinesSeeder extends Seeder
{
    public function run(): void
    {
        $factory = Factory::where('name', 'GPP')->first();

        if (!$factory) {
            $this->command->error('GPP Factory not found!');
            return;
        }

        $machines = [
            ['serial' => '1.1.1.1', 'name' => 'WATER PUMP', 'hours' => 5708, 'type' => 'GPP'],
            ['serial' => '1.2.1.1', 'name' => 'BOX FEEDER NO.1 صندوق التغذية', 'hours' => 6058, 'type' => 'GPP'],
            ['serial' => '1.2.1.10', 'name' => 'METAL BELT CONVEYOR الناقل المعدني', 'hours' => 5739, 'type' => 'GPP'],
            ['serial' => '1.2.1.11', 'name' => 'DRUM DRYER المجفف', 'hours' => 5482, 'type' => 'GPP'],
            ['serial' => '1.2.1.12', 'name' => 'PLATE BELT CONVEYOR', 'hours' => 5199, 'type' => 'PREPARATION'],
            ['serial' => '1.2.1.13', 'name' => 'SCREW CONVEYOR', 'hours' => 5530, 'type' => 'GPP'],
            ['serial' => '1.2.1.13.20', 'name' => 'DOUBLE MIXTURE SHAFT خلاط مزدوج', 'hours' => 4590, 'type' => 'PREPARATION'],
            ['serial' => '1.2.1.13.23', 'name' => 'SCREW CONVEYOR', 'hours' => 5543, 'type' => 'GPP'],
            ['serial' => '1.2.1.14', 'name' => 'MUFFLE FURNACE', 'hours' => 5485, 'type' => 'GPP'],
            ['serial' => '1.2.1.15', 'name' => 'FAN مروحة', 'hours' => 5482, 'type' => 'GPP'],
            ['serial' => '1.2.1.15.3', 'name' => 'FAN مروحة', 'hours' => 5485, 'type' => 'GPP'],
            ['serial' => '1.2.1.16', 'name' => 'BUCKET ELVATOR رافع القواديس', 'hours' => 5318, 'type' => 'PREPARATION'],
            ['serial' => '1.2.1.17', 'name' => 'BELT CONVEYORE سير ناقل للحركة', 'hours' => 4807, 'type' => 'PREPARATION'],
            ['serial' => '1.2.1.18', 'name' => 'SILO\'S 90 M^3 خزان التعبئة', 'hours' => 11653, 'type' => 'PREPARATION'],
            ['serial' => '1.2.1.18.3', 'name' => 'WRG - SILDING DAMPER صمام تحكم انزلاقي', 'hours' => 10926, 'type' => 'PREPARATION'],
            ['serial' => '1.2.1.19', 'name' => 'BOX FEEDER صندوق التغذية', 'hours' => 5674, 'type' => 'PREPARATION'],
            ['serial' => '1.2.1.20', 'name' => 'ROLLER CRUSHER كسارة', 'hours' => 7676, 'type' => 'GPP'],
            ['serial' => '1.2.1.21', 'name' => 'BELT CONVEYORE سير ناقل للحركة', 'hours' => 5640, 'type' => 'PREPARATION'],
            ['serial' => '1.2.1.22', 'name' => 'DEDUSTING FILTER مصفي الغبار', 'hours' => 10286, 'type' => 'PREPARATION'],
            ['serial' => '1.2.1.22.25', 'name' => 'DEDUSTING FAN', 'hours' => 10375, 'type' => 'PREPARATION'],
            ['serial' => '1.2.1.22.5', 'name' => 'ROTARY VALVE صمام دوار', 'hours' => 9213, 'type' => 'PREPARATION'],
            ['serial' => '1.2.1.3', 'name' => 'BOX FEEDER NO. 2', 'hours' => 6007, 'type' => 'GPP'],
            ['serial' => '1.2.1.4', 'name' => 'METAL BELT CONVEYOR', 'hours' => 5993, 'type' => 'GPP'],
            ['serial' => '1.2.1.5', 'name' => 'BELT CONVEYOR', 'hours' => 5996, 'type' => 'GPP'],
            ['serial' => '1.2.1.6', 'name' => 'SCREW CONVEYOR', 'hours' => 711, 'type' => 'GPP'],
            ['serial' => '1.2.1.6.17', 'name' => 'SCREW CONVEYOR', 'hours' => 5981, 'type' => 'GPP'],
            ['serial' => '1.2.1.6.3', 'name' => 'FAN', 'hours' => 6044, 'type' => 'GPP'],
            ['serial' => '1.2.1.6.6', 'name' => 'SCREW CONVEYOR ناقل حلزونى', 'hours' => 5976, 'type' => 'GPP'],
            ['serial' => '1.2.1.6.9', 'name' => 'BUCKET ELEVATOR', 'hours' => 5961, 'type' => 'GPP'],
            ['serial' => '1.2.1.7', 'name' => 'DOUBLE SHAFT MIXER', 'hours' => 5983, 'type' => 'GPP'],
            ['serial' => '1.2.1.8', 'name' => 'METAL BELT CONVEYOR', 'hours' => 5961, 'type' => 'GPP'],
            ['serial' => '1.2.1.9', 'name' => 'CIRCULAR SCREEN FEEDER', 'hours' => 5471, 'type' => 'GPP'],
            ['serial' => '1.2.2.1', 'name' => 'TABEL FEEDER طاولة التغذية', 'hours' => 11654, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.10', 'name' => 'SCREW CONVEYOR ناقل حلزونى', 'hours' => 4161, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.2', 'name' => 'MILL الطاحونة', 'hours' => 10084, 'type' => 'GRINDING AREA'],
            ['serial' => '1.2.2.2.01', 'name' => 'LUBRICATION SYSTEM نظام التزييت', 'hours' => 12264, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.2.07', 'name' => 'HYDROLIC CABINT صندوق هيدروليك', 'hours' => 12220, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.2.1', 'name' => 'MILL GEAR BOX صندوق تروس الطاحونة', 'hours' => 12265, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.3', 'name' => 'CLASSIFIER مصنف المادة', 'hours' => 7201, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.4', 'name' => 'FILTER مصفي', 'hours' => 12262, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.4.5', 'name' => 'FILTER SCREW CONVEYOR مصفى الناقل', 'hours' => 10214, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.4.7', 'name' => 'ROTARY VALVE صمام الدوار', 'hours' => 10466, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.5', 'name' => 'RADIAL FAN مروحة محورية', 'hours' => 10537, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.6', 'name' => 'BURNER الفرن', 'hours' => 10346, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.7', 'name' => 'IPAU PUMP مضخة حلزونية', 'hours' => 10555, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.7.3', 'name' => 'ROTARY PISTON BLOWER ضاغط دوار', 'hours' => 10320, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.7.6', 'name' => 'FLOW METER QUANTITY عداد قياس الكمية', 'hours' => 7505, 'type' => 'GRINDING'],
            ['serial' => '1.2.2.9.6', 'name' => 'SCREW CONVEYOR الناقل الحلزونى', 'hours' => 6171, 'type' => 'PACKING'],
            ['serial' => '1.2.3.1', 'name' => 'BUCKET ELEVATOR رافع القواديس', 'hours' => 7667, 'type' => 'PACKING'],
            ['serial' => '1.2.3.2', 'name' => 'NIAGRA SCREEN FEEDER الغربال المغذي', 'hours' => 7117, 'type' => 'PACKING'],
            ['serial' => '1.2.3.3', 'name' => 'PACKING STORGE SILO خزان التعبئة', 'hours' => 7188, 'type' => 'PACKING'],
            ['serial' => '1.2.3.4', 'name' => 'ROTARY VALVE FOR PACKING SILO الصمام الدوار لخزان التعبئة', 'hours' => 6748, 'type' => 'PACKING'],
            ['serial' => '1.2.3.5', 'name' => 'PACKING MACHINE الة التعبئة', 'hours' => 6773, 'type' => 'PACKING'],
            ['serial' => '1.2.3.5.10', 'name' => 'FLAT BELT CONVEYOR السير المسطح', 'hours' => 7937, 'type' => 'PACKING'],
            ['serial' => '1.2.3.5.11', 'name' => 'BAG CLEANING STATION الة التنظيف لاكياس التعبئة', 'hours' => 8435, 'type' => 'PACKING'],
            ['serial' => '1.2.3.5.12', 'name' => 'WIRE BELT CONVEYOR ناقل حديدى شبكى', 'hours' => 7827, 'type' => 'PACKING'],
            ['serial' => '1.2.3.5.6', 'name' => 'SCREW CONVEYOR السير الحلزونى', 'hours' => 7663, 'type' => 'PACKING'],
            ['serial' => '1.2.3.5.7', 'name' => 'FILTER SCREW CONVEYOR', 'hours' => 7904, 'type' => 'PACKING'],
            ['serial' => '1.2.3.6', 'name' => 'FILTER FOR PACKING', 'hours' => 7305, 'type' => 'PACKING'],
            ['serial' => '1.2.3.6.1', 'name' => 'ROTARY VLAVE الصمام الدوار', 'hours' => 7841, 'type' => 'PACKING'],
            ['serial' => '1.2.3.6.2', 'name' => 'DEDUSTING FAN', 'hours' => 7749, 'type' => 'PACKING'],
            ['serial' => '1.2.3.6.25', 'name' => 'DEDUSTING FAN FOR PACKING', 'hours' => 7342, 'type' => 'PACKING'],
            ['serial' => '1.4.1.3.19', 'name' => 'LOADING MACHINE', 'hours' => 11675, 'type' => 'SILO'],
            ['serial' => '1.4.1.3.4', 'name' => 'BUCKET WHEEL FEEDER', 'hours' => 1288, 'type' => 'SILO'],
            ['serial' => '1.4.1.4.1', 'name' => 'DEDUSTING FILTER FOR SILO NO(1)', 'hours' => 12827, 'type' => 'SILO'],
            ['serial' => '1.4.1.4.3.4', 'name' => 'DEDUSTING FAN FOR SILO NO(1)', 'hours' => 12919, 'type' => 'SILO (1)'],
            ['serial' => '1.5.1.1', 'name' => 'TIMING CONVEYOR', 'hours' => 3869, 'type' => 'PALATIZING'],
            ['serial' => '1.5.1.2', 'name' => 'BELT CONVEYOR', 'hours' => 6962, 'type' => 'PALATIZING'],
            ['serial' => '1.5.1.2.5', 'name' => 'BELT CONVEYOR', 'hours' => 7737, 'type' => 'PALATIZING'],
            ['serial' => '1.5.1.3', 'name' => 'BELT CONVEYOR', 'hours' => 4303, 'type' => 'PALATIZING'],
            ['serial' => '1.5.1.4', 'name' => 'BELT CONVEYOR', 'hours' => 4721, 'type' => 'PALATIZING'],
            ['serial' => '1.5.2.1', 'name' => 'CONVEYOR', 'hours' => 4666, 'type' => 'GPP'],
            ['serial' => '1.5.3.1.4', 'name' => 'CONVEYOR', 'hours' => 3300, 'type' => 'GPP'],
            ['serial' => '1.CR1', 'name' => 'COMPUTER SYSTEM FOR GRINDING', 'hours' => 2733, 'type' => 'GPP'],
            ['serial' => '1.CR2', 'name' => 'COMPUTER SYSTEM FOR PACKING', 'hours' => 9535, 'type' => 'CONTROL ROOM'],
            ['serial' => '1.CR3', 'name' => 'COMPUTER SYSTEM FOR PREPARATION', 'hours' => 2466, 'type' => 'GPP'],
            ['serial' => '1.OP1', 'name' => 'OPERATION PANEL FOR PREPARATION', 'hours' => 0, 'type' => 'GPP'],
            ['serial' => '1.OP3', 'name' => 'COMPUTER SYSTEM FOR PREPARATION', 'hours' => 0, 'type' => 'GPP'],
        ];

        foreach ($machines as $item) {
            Machine::updateOrCreate(
                ['serial_number' => $item['serial']],
                [
                    'factory_id' => $factory->id,
                    'production_line' => 'خط البينتونايت',
                    'name' => $item['name'],
                    'type' => $item['type'],
                    'total_operating_hours' => $item['hours'],
                    'status' => 'active',
                ]
            );
        }
    }
}
