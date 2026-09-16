<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير مهام المهندسين</title>
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
                <h4 class="text-muted">تقرير مهام الصيانة والمهندسين</h4>
            </div>
            <div>
                <img src="{{ asset('logo.png') }}" alt="Jowfe Logo" class="logo-img">
            </div>
        </div>

        <!-- Meta Info -->
        <div class="d-flex justify-content-between mb-4">
            <p><strong>تاريخ استخراج التقرير:</strong> {{ now()->format('Y-m-d H:i') }}</p>
            <p><strong>إجمالي المهام المسجلة:</strong> {{ $tasks->count() }} مهمة</p>
        </div>

        <!-- Data Table -->
        <table class="table table-bordered table-striped text-center align-middle">
            <thead>
                <tr>
                    <th>رقم الأمر</th>
                    <th>الآلة المستهدفة</th>
                    <th>المهندس المكلف</th>
                    <th>التخصص</th>
                    <th>نوع الصيانة</th>
                    <th>ملاحظات</th>
                    <th>حالة الإنجاز</th>
                    <th>تاريخ الجدولة</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                <tr>
                    <td class="fw-bold">#{{ $task->id }}</td>
                    <td dir="ltr">{{ $task->machine->serial_number ?? 'غير محدد' }}</td>
                    <td class="fw-bold">{{ $task->engineer->user->name ?? 'غير مكلف بعد' }}</td>
                    <td>
                        {{ $task->category == 'mechanical' ? 'ميكانيكا' : ($task->category == 'electrical' ? 'كهرباء' : 'عام') }}
                    </td>
                    <td>
                        {{ $task->type == 'preventive' ? 'وقائية' : 'تصحيحية (عطل)' }}
                    </td>
                    <td>
                        <small>
                            @if($task->catalog)
                                <strong>[{{ $task->catalog->code }}]:</strong> {{ $task->catalog->description }}<br>
                            @endif
                            {{ Str::limit($task->notes ?? 'لا توجد ملاحظات إضافية', 50) }}
                        </small>
                    </td>
                    <td>
                        @if($task->status == 'pending')
                            قيد الانتظار
                        @elseif($task->status == 'in_progress')
                            جاري العمل
                        @elseif($task->status == 'completed')
                            مكتملة
                        @endif
                    </td>
                    <td dir="ltr">{{ \Carbon\Carbon::parse($task->scheduled_date)->format('Y-m-d') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">لا توجد أوامر صيانة لطباعتها</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Footer -->
        <div class="mt-5 text-center text-muted" style="font-size: 12px;">
            <p>نهاية التقرير - صادر عن قسم الصيانة الهندسية (الجوف)</p>
        </div>
    </div>

</body>
</html>
