<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير سجل الآلات والمعدات</title>
    <!-- Bootstrap CSS (RTL) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    
    <style>
        body {
            font-family: 'Cairo', 'Tajawal', sans-serif;
            background-color: #fff;
            color: #000;
        }
        .report-header {
            border-bottom: 3px solid #b8860b; /* Jowfe Gold */
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo-img {
            max-width: 150px;
        }
        table th {
            background-color: #f8f9fa !important;
            -webkit-print-color-adjust: exact;
        }
        
        /* Print Styles */
        @media print {
            body { margin: 0; padding: 20px; }
            .no-print { display: none !important; }
            .table-bordered { border: 1px solid #000 !important; }
            .table-bordered th, .table-bordered td { border: 1px solid #000 !important; }
            @page { size: A4 portrait; margin: 20mm; }
        }
    </style>
</head>
<body>

    <!-- Floating Print Button -->
    <div class="position-fixed bottom-0 end-0 p-4 no-print">
        <button onclick="window.print()" class="btn btn-primary btn-lg shadow rounded-circle" style="width: 60px; height: 60px; font-size: 24px;" title="طباعة">
            🖨️
        </button>
    </div>

    <div class="container mt-4">
        <!-- Header -->
        <div class="report-header d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1">شركة الجوف للتقنية</h2>
                <h4 class="text-muted">تقرير سجل الآلات والمعدات الشامل</h4>
            </div>
            <div>
                <img src="{{ asset('logo.png') }}" alt="Jowfe Logo" class="logo-img">
            </div>
        </div>

        <!-- Meta Info -->
        <div class="d-flex justify-content-between mb-4">
            <p><strong>تاريخ استخراج التقرير:</strong> {{ now()->format('Y-m-d H:i') }}</p>
            <p><strong>إجمالي الآلات:</strong> {{ $machines->count() }} آلة</p>
        </div>

        <!-- Data Table -->
        <table class="table table-bordered table-striped text-center align-middle">
            <thead>
                <tr>
                    <th>م</th>
                    <th>رقم الآلة (Tag)</th>
                    <th>اسم الآلة</th>
                    <th>المصنع التابع لها</th>
                    <th>الحالة الحالية</th>
                    <th>ساعات التشغيل</th>
                    <th>تاريخ التسجيل</th>
                </tr>
            </thead>
            <tbody>
                @forelse($machines as $index => $machine)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td dir="ltr" class="fw-bold">{{ $machine->serial_number }}</td>
                    <td class="fw-bold">{{ $machine->name }}</td>
                    <td>{{ $machine->factory->name ?? 'غير محدد' }}</td>
                    <td>
                        @if($machine->status == 'active')
                            تعمل
                        @elseif($machine->status == 'maintenance')
                            في الصيانة
                        @else
                            متوقفة
                        @endif
                    </td>
                    <td dir="ltr">{{ number_format($machine->total_operating_hours) }}</td>
                    <td dir="ltr">{{ $machine->created_at->format('Y-m-d') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">لا توجد بيانات متاحة للطباعة</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Footer -->
        <div class="mt-5 text-center text-muted" style="font-size: 12px;">
            <p>نهاية التقرير - صادر عن منظومة إدارة الصيانة (الجوف)</p>
        </div>
    </div>

</body>
</html>
