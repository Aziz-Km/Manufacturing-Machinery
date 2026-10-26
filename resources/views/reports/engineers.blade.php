<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير مهام المهندسين - شركة الجوف</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f8f9fa;
            color: #212529;
        }

        .report-page-container {
            max-width: 1250px;
            margin: 20px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        }

        .report-header {
            border-bottom: 3px solid #d4af37; /* Jowfe Gold */
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .logo-img {
            max-height: 75px;
            width: auto;
            object-fit: contain;
        }

        .table th {
            background-color: #f1f3f5 !important;
            color: #333;
            font-weight: 700;
            border-bottom: 2px solid #dee2e6;
            vertical-align: middle;
        }

        .table td {
            vertical-align: middle;
            font-size: 0.95rem;
        }

        .badge-status {
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 4px;
        }

        /* Print Media Styles */
        @media print {
            body {
                background-color: #fff !important;
                color: #000 !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .report-page-container {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                border: none !important;
            }

            .no-print {
                display: none !important;
            }

            .table-bordered {
                border: 1px solid #333 !important;
            }

            .table-bordered th, 
            .table-bordered td {
                border: 1px solid #666 !important;
                padding: 6px 8px !important;
                font-size: 11px !important;
            }

            .table th {
                background-color: #ececec !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .badge {
                border: 1px solid #333 !important;
                color: #000 !important;
                background-color: transparent !important;
            }

            .report-header {
                border-bottom: 2px solid #333 !important;
                padding-bottom: 15px;
                margin-bottom: 15px;
            }

            .signatures-section {
                break-inside: avoid;
                margin-top: 30px !important;
            }

            @page {
                size: A4 landscape;
                margin: 10mm;
            }
        }
    </style>
</head>
<body>

    <!-- Control & Filter Bar (Hidden in Print) -->
    <div class="container-fluid py-3 mb-3 bg-white border-bottom shadow-sm no-print">
        <div class="container-fluid px-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary btn-sm fw-bold">
                        <i class="fas fa-tools me-1"></i> أوامر الصيانة
                    </a>
                    <a href="{{ route('engineers.index') }}" class="btn btn-outline-secondary btn-sm fw-bold">
                        <i class="fas fa-users-cog me-1"></i> المهندسين
                    </a>
                    <h5 class="fw-bold mb-0 text-dark ms-2">
                        <i class="fas fa-print text-warning me-1"></i> استعراض وطباعة تقرير مهام المهندسين
                    </h5>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <button onclick="window.print()" class="btn btn-primary fw-bold px-4 shadow-sm" style="background-color: #d4af37; border-color: #d4af37;">
                        <i class="fas fa-print me-1"></i> طباعة التقرير الآن (A4)
                    </button>
                </div>
            </div>

            <!-- Filters Section -->
            <form action="{{ route('reports.engineers') }}" method="GET" class="row g-2 align-items-end mt-2 pt-3 border-top">
                <div class="col-md-3">
                    <label class="form-label small fw-bold mb-1">المهندس المكلف:</label>
                    <select name="engineer_id" class="form-select form-select-sm">
                        <option value="">-- كل المهندسين --</option>
                        @foreach($engineers as $eng)
                            <option value="{{ $eng->id }}" {{ request('engineer_id') == $eng->id ? 'selected' : '' }}>
                                {{ $eng->user->name ?? 'مهندس' }} ({{ $eng->specialization }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-bold mb-1">حالة المهمة:</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">-- كل الحالات --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ قيد الانتظار</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>⚙️ جاري العمل</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✅ مكتملة</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-bold mb-1">التخصص:</label>
                    <select name="category" class="form-select form-select-sm">
                        <option value="">-- كل التخصصات --</option>
                        <option value="mechanical" {{ request('category') == 'mechanical' ? 'selected' : '' }}>ميكانيكا</option>
                        <option value="electrical" {{ request('category') == 'electrical' ? 'selected' : '' }}>كهرباء</option>
                        <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>عام</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-bold mb-1">من تاريخ:</label>
                    <input type="date" name="from_date" class="form-control form-control-sm" value="{{ request('from_date') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-bold mb-1">إلى تاريخ:</label>
                    <input type="date" name="to_date" class="form-control form-control-sm" value="{{ request('to_date') }}">
                </div>

                <div class="col-md-1 d-flex gap-1">
                    <button type="submit" class="btn btn-dark btn-sm w-100 fw-bold">
                        تصفية
                    </button>
                    @if(request()->anyFilled(['engineer_id', 'status', 'category', 'type', 'from_date', 'to_date']))
                        <a href="{{ route('reports.engineers') }}" class="btn btn-outline-secondary btn-sm" title="إعادة الضبط">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Main Report Document Page -->
    <div class="report-page-container">
        
        <!-- Document Header -->
        <div class="report-header d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1 text-dark">شركة الجوف للتقنية</h3>
                <h5 class="text-secondary mb-1">إدارة الصيانة الهندسية والتشغيل</h5>
                <h4 class="fw-bold text-dark mt-2">
                    <i class="fas fa-file-contract text-warning me-1"></i>
                    تقرير وجدول مهام أوامر الصيانة الهندسية
                </h4>
            </div>
            <div class="text-center">
                <img src="{{ asset('logo.png') }}" alt="Jowfe Logo" class="logo-img mb-1">
                <div class="small text-muted fw-bold">{{ now()->format('Y-m-d H:i') }}</div>
            </div>
        </div>

        <!-- Filter / Selected Profile Bar -->
        <div class="row g-3 mb-4 align-items-center">
            <div class="col-md-7">
                @if($selectedEngineer)
                    <div class="p-3 bg-light rounded border border-start border-4 border-warning">
                        <span class="text-muted small d-block mb-1">بيانات المهندس المحدّد:</span>
                        <h5 class="fw-bold text-dark mb-1">
                            <i class="fas fa-user-circle text-primary me-1"></i>
                            {{ $selectedEngineer->user->name ?? 'غير محدد' }}
                        </h5>
                        <div class="small text-muted">
                            <span class="me-3"><strong>الرقم الوظيفي:</strong> {{ $selectedEngineer->employee_id ?? '-' }}</span>
                            <span class="me-3"><strong>التخصص:</strong> {{ $selectedEngineer->specialization }}</span>
                            <span><strong>البريد:</strong> {{ $selectedEngineer->user->email ?? '-' }}</span>
                        </div>
                    </div>
                @else
                    <div class="p-3 bg-light rounded border">
                        <span class="text-muted small d-block">نطاق التقرير:</span>
                        <h5 class="fw-bold text-dark mb-0">
                            <i class="fas fa-users-cog text-secondary me-1"></i>
                            تقرير شامل لكافة المهندسين وفرق الصيانة
                        </h5>
                    </div>
                @endif
            </div>

            <!-- Summary Stats Badges -->
            <div class="col-md-5">
                <div class="d-flex justify-content-end gap-2 text-center">
                    <div class="p-2 px-3 border rounded bg-light">
                        <span class="small text-muted d-block">إجمالي المهام</span>
                        <span class="fw-bold fs-5 text-dark">{{ $stats['total'] }}</span>
                    </div>
                    <div class="p-2 px-3 border rounded bg-secondary bg-opacity-10 text-secondary">
                        <span class="small d-block">قيد الانتظار</span>
                        <span class="fw-bold fs-5">{{ $stats['pending'] }}</span>
                    </div>
                    <div class="p-2 px-3 border rounded bg-warning bg-opacity-10 text-dark">
                        <span class="small d-block">جاري العمل</span>
                        <span class="fw-bold fs-5">{{ $stats['in_progress'] }}</span>
                    </div>
                    <div class="p-2 px-3 border rounded bg-success bg-opacity-10 text-success">
                        <span class="small d-block">مكتملة</span>
                        <span class="fw-bold fs-5">{{ $stats['completed'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Meta Sub-Info -->
        <div class="d-flex justify-content-between mb-3 text-muted small border-bottom pb-2">
            <div>
                <strong>تاريخ استخراج التقرير:</strong> {{ now()->format('Y-m-d') }} ({{ now()->format('H:i') }})
                @if(request('from_date') || request('to_date'))
                    <span class="ms-3"><strong>الفترة الزمنية:</strong> من {{ request('from_date') ?: 'البداية' }} إلى {{ request('to_date') ?: 'الآن' }}</span>
                @endif
            </div>
            <div>
                <strong>المُستخرج بواسطة:</strong> {{ Auth::user()->name ?? 'مسؤول النظام' }}
            </div>
        </div>

        <!-- Data Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 7%;">رقم الأمر</th>
                        <th style="width: 18%;" class="text-start">الآلة / المعدة المستهدفة</th>
                        <th style="width: 14%;">المهندس المكلف</th>
                        <th style="width: 11%;">التخصص والنوع</th>
                        <th style="width: 24%;" class="text-start">المهمة القياسية / الملاحظات الفنية</th>
                        <th style="width: 9%;">تاريخ الجدولة</th>
                        <th style="width: 9%;">تاريخ الإنجاز</th>
                        <th style="width: 8%;">الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                    <tr>
                        <td class="fw-bold">#{{ $task->id }}</td>
                        
                        <td class="text-start">
                            <span class="fw-bold text-dark" dir="ltr">{{ $task->machine->serial_number ?? 'غير محدد' }}</span>
                            <div class="small text-muted">{{ $task->machine->name ?? '' }}</div>
                            @if($task->machine && $task->machine->factory)
                                <small class="badge bg-light text-dark border">{{ $task->machine->factory->name }}</small>
                            @endif
                        </td>

                        <td class="fw-bold">
                            @if($task->engineer && $task->engineer->user)
                                <span>{{ $task->engineer->user->name }}</span>
                                <div class="small text-muted font-monospace">({{ $task->engineer->specialization }})</div>
                            @else
                                <span class="text-muted small fst-italic">غير محدد</span>
                            @endif
                        </td>

                        <td>
                            <div class="fw-bold">
                                @if($task->category == 'mechanical')
                                    ميكانيكا
                                @elseif($task->category == 'electrical')
                                    كهرباء
                                @else
                                    عام
                                @endif
                            </div>
                            <span class="small text-muted">
                                {{ $task->type == 'preventive' ? 'وقائية' : 'تصحيحية (عطل)' }}
                            </span>
                        </td>

                        <td class="text-start">
                            @if($task->catalog)
                                <div class="small fw-bold text-primary" dir="ltr">
                                    <i class="fas fa-list-check me-1"></i> [{{ $task->catalog->code }}] {{ $task->catalog->description }}
                                </div>
                            @endif
                            @if($task->notes)
                                <div class="small text-dark mt-1" style="line-height: 1.4;">
                                    {{ Str::limit($task->notes, 75) }}
                                </div>
                            @elseif(!$task->catalog)
                                <span class="text-muted small fst-italic">لا توجد ملاحظات</span>
                            @endif
                        </td>

                        <td dir="ltr" class="small fw-bold">
                            {{ $task->scheduled_date ? $task->scheduled_date->format('Y-m-d') : '---' }}
                        </td>

                        <td dir="ltr" class="small fw-bold text-success">
                            {{ $task->completion_date ? $task->completion_date->format('Y-m-d') : '---' }}
                        </td>

                        <td>
                            @if($task->status == 'pending')
                                <span class="badge bg-secondary badge-status">قيد الانتظار</span>
                            @elseif($task->status == 'in_progress')
                                <span class="badge bg-warning text-dark badge-status">جاري العمل</span>
                            @elseif($task->status == 'completed')
                                <span class="badge bg-success badge-status">مكتملة</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fs-2 d-block mb-2"></i>
                            لا توجد أوامر صيانة مسجلة مطابقة لمعايير البحث الحالية.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Official Endorsement & Signatures Section -->
        <div class="signatures-section mt-5 pt-3 border-top">
            <h6 class="fw-bold mb-4 text-center text-muted">
                اعتمادات وتوقيعات قسم الصيانة الهندسية
            </h6>
            <div class="row text-center pt-2">
                <div class="col-4">
                    <p class="fw-bold mb-1">المهندس المسؤول</p>
                    <p class="text-muted small mb-4">
                        {{ $selectedEngineer ? $selectedEngineer->user->name : '....................................' }}
                    </p>
                    <p class="text-muted">التوقيع: ....................................</p>
                </div>
                <div class="col-4">
                    <p class="fw-bold mb-1">مشرف قسم الصيانة</p>
                    <p class="text-muted small mb-4">....................................</p>
                    <p class="text-muted">التوقيع: ....................................</p>
                </div>
                <div class="col-4">
                    <p class="fw-bold mb-1">مدير إدارة المصانع والتشغيل</p>
                    <p class="text-muted small mb-4">....................................</p>
                    <p class="text-muted">التوقيع: ....................................</p>
                </div>
            </div>
            
            <div class="mt-4 text-center text-muted small" style="font-size: 11px;">
                <p class="mb-0">نهاية التقرير - صادر إلكترونياً عن منظومة إدارة وصيانة الآلات - شركة الجوف للتقنية</p>
            </div>
        </div>

    </div>

    <!-- Floating Print Button (Bottom Right) -->
    <div class="position-fixed bottom-0 end-0 p-4 no-print">
        <button onclick="window.print()" class="btn btn-warning btn-lg shadow rounded-circle text-white" style="width: 58px; height: 58px; font-size: 22px; background-color: #d4af37; border-color: #d4af37;" title="طباعة التقرير">
            <i class="fas fa-print"></i>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
