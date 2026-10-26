@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <!-- Session Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show fw-bold mb-4 shadow-sm no-print" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Navigation and Actions Bar (Hidden in Print) -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 no-print gap-3">
                <div>
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary fw-bold px-3 me-2">
                        <i class="fas fa-arrow-right me-1"></i> العودة للأوامر
                    </a>
                    <span class="fs-4 fw-bold text-gold">
                        أمر صيانة رقم #{{ $task->id }}
                    </span>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-success fw-bold px-4" data-bs-toggle="modal" data-bs-target="#statusModal-{{ $task->id }}">
                        <i class="fas fa-sync-alt me-1"></i> تحديث الحالة
                    </button>
                    <button onclick="window.print()" class="btn btn-outline-dark fw-bold px-3" title="طباعة أمر العمل">
                        <i class="fas fa-print me-1"></i> طباعة أمر العمل
                    </button>
                </div>
            </div>

            <!-- Print-Only Header -->
            <div class="d-none d-print-block print-header mb-4 border-bottom pb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold mb-1">شركة الجوف للتقنية</h2>
                        <h4 class="text-muted mb-1">إدارة الصيانة والتشغيل</h4>
                        <h5 class="fw-bold text-dark mt-2">استمارة أمر عمل وصيانة (Work Order) #{{ $task->id }}</h5>
                    </div>
                    <div class="text-center">
                        <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 70px; object-fit: contain;">
                        <div class="small text-muted mt-1">{{ now()->format('Y-m-d H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Status Stepper Bar (Web & Print) -->
            <div class="card shadow-sm border-0 mb-4 overflow-hidden">
                <div class="card-body p-4 bg-white">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                            <span class="text-muted d-block small">حالة أمر الصيانة:</span>
                            @if($task->status == 'pending')
                                <span class="badge bg-secondary fs-5 px-3 py-2 mt-1">
                                    <i class="fas fa-clock me-1"></i> قيد الانتظار
                                </span>
                            @elseif($task->status == 'in_progress')
                                <span class="badge bg-warning text-dark fs-5 px-3 py-2 mt-1">
                                    <i class="fas fa-tools fa-spin me-1"></i> جاري العمل (تحت التنفيذ)
                                </span>
                            @elseif($task->status == 'completed')
                                <span class="badge bg-success fs-5 px-3 py-2 mt-1">
                                    <i class="fas fa-check-circle me-1"></i> تم إنجاز الصيانة بنجاح
                                </span>
                            @endif
                        </div>

                        <!-- Progress Steps -->
                        <div class="col-md-8">
                            <div class="d-flex justify-content-between position-relative text-center">
                                <!-- Step 1: Created -->
                                <div class="step-item flex-fill">
                                    <div class="step-icon rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center bg-success text-white" style="width: 40px; height: 40px;">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <span class="fw-bold small d-block">تم الإصدار</span>
                                    <span class="text-muted small" dir="ltr">{{ $task->created_at->format('Y-m-d') }}</span>
                                </div>

                                <!-- Step 2: In Progress -->
                                <div class="step-item flex-fill">
                                    <div class="step-icon rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center {{ in_array($task->status, ['in_progress', 'completed']) ? 'bg-warning text-dark' : 'bg-light text-muted border' }}" style="width: 40px; height: 40px;">
                                        <i class="fas fa-wrench"></i>
                                    </div>
                                    <span class="fw-bold small d-block">قيد التنفيذ</span>
                                    <span class="text-muted small" dir="ltr">
                                        {{ $task->scheduled_date ? $task->scheduled_date->format('Y-m-d') : 'مجدول' }}
                                    </span>
                                </div>

                                <!-- Step 3: Completed -->
                                <div class="step-item flex-fill">
                                    <div class="step-icon rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center {{ $task->status == 'completed' ? 'bg-success text-white' : 'bg-light text-muted border' }}" style="width: 40px; height: 40px;">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="fw-bold small d-block">اكتمال الصيانة</span>
                                    <span class="text-muted small" dir="ltr">
                                        {{ $task->completion_date ? $task->completion_date->format('Y-m-d') : '---' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Cards -->
            <div class="row g-4">
                
                <!-- Machine Specifications Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-gold text-white fw-bold">
                            <i class="fas fa-cogs me-2"></i> بيانات الآلة / المعدة
                        </div>
                        <div class="card-body p-4">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <th class="text-muted py-2" style="width: 42%;">رقم الآلة (Tag):</th>
                                    <td class="fw-bold fs-5 text-primary py-2" dir="ltr">
                                        {{ $task->machine->serial_number ?? 'غير محدد' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted py-2">اسم الآلة:</th>
                                    <td class="fw-bold text-dark py-2">{{ $task->machine->name ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted py-2">المصنع:</th>
                                    <td class="py-2">
                                        <span class="badge bg-secondary fs-6">
                                            {{ $task->machine->factory->name ?? 'غير محدد' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted py-2">خط الإنتاج:</th>
                                    <td class="fw-bold text-muted py-2">{{ $task->machine->production_line ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted py-2">النوع / الموقع:</th>
                                    <td class="py-2" dir="ltr">
                                        <span class="badge bg-info text-dark">{{ $task->machine->type ?? 'غير محدد' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted py-2">ساعات التشغيل:</th>
                                    <td class="fw-bold text-dark py-2" dir="ltr">
                                        {{ number_format($task->machine->total_operating_hours ?? 0) }} ساعة
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted py-2">حالة الآلة الحالية:</th>
                                    <td class="py-2">
                                        @if(($task->machine->status ?? '') == 'active')
                                            <span class="badge bg-success">نشطة / تعمل</span>
                                        @elseif(($task->machine->status ?? '') == 'maintenance')
                                            <span class="badge bg-warning text-dark">في الصيانة</span>
                                        @else
                                            <span class="badge bg-danger">{{ $task->machine->status ?? 'غير محدد' }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Work Order & Execution Details -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-gold text-white fw-bold">
                            <i class="fas fa-clipboard-list me-2"></i> تفاصيل ومحددات العمل
                        </div>
                        <div class="card-body p-4">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <th class="text-muted py-2" style="width: 42%;">تخصص الصيانة:</th>
                                    <td class="py-2">
                                        @if($task->category == 'mechanical')
                                            <span class="badge bg-primary fs-6"><i class="fas fa-cogs me-1"></i> ميكانيكا</span>
                                        @elseif($task->category == 'electrical')
                                            <span class="badge bg-warning text-dark fs-6"><i class="fas fa-bolt me-1"></i> كهرباء</span>
                                        @else
                                            <span class="badge bg-secondary fs-6"><i class="fas fa-tools me-1"></i> عام</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted py-2">نوع الصيانة:</th>
                                    <td class="py-2">
                                        @if($task->type == 'preventive')
                                            <span class="badge bg-info text-dark fs-6">وقائية (دورية)</span>
                                        @else
                                            <span class="badge bg-danger fs-6">تصحيحية (إصلاح عطل)</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted py-2">المهندس المكلف:</th>
                                    <td class="fw-bold fs-6 text-primary py-2">
                                        <i class="fas fa-user-circle me-1"></i>
                                        {{ $task->engineer->user->name ?? 'لم يُحدد بعد' }}
                                        @if($task->engineer)
                                            <span class="small text-muted d-block">
                                                التخصص: {{ $task->engineer->specialization }}
                                                @if($task->engineer->employee_id)
                                                    | الرقم: {{ $task->engineer->employee_id }}
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted py-2">تاريخ إصدار الأمر:</th>
                                    <td class="py-2" dir="ltr">{{ $task->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted py-2">تاريخ الجدولة:</th>
                                    <td class="fw-bold py-2" dir="ltr">
                                        {{ $task->scheduled_date ? $task->scheduled_date->format('Y-m-d') : 'غير محدد' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted py-2">تاريخ الإنجاز الفعلي:</th>
                                    <td class="fw-bold text-success py-2" dir="ltr">
                                        @if($task->completion_date)
                                            <i class="fas fa-check-circle me-1"></i> {{ $task->completion_date->format('Y-m-d') }}
                                        @else
                                            <span class="text-muted">لم يكتمل بعد</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Catalog Task Reference -->
                @if($task->catalog)
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-secondary text-white fw-bold">
                            <i class="fas fa-list-check me-2"></i> بند كتالوج المهام القياسية المعتمد
                        </div>
                        <div class="card-body p-4 bg-light">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <span class="text-muted d-block small">رمز المهمة القياسي:</span>
                                    <span class="badge bg-dark fs-5 mt-1" dir="ltr">{{ $task->catalog->code }}</span>
                                </div>
                                <div class="col-md-7">
                                    <span class="text-muted d-block small">وصف الإجراء المطلوب:</span>
                                    <span class="fs-5 fw-bold text-dark mt-1 d-block" dir="ltr">{{ $task->catalog->description }}</span>
                                </div>
                                <div class="col-md-2 text-md-end">
                                    <span class="text-muted d-block small">تسلسل الكتالوج:</span>
                                    <span class="fw-bold fs-6 mt-1 d-block">#{{ $task->catalog->sequence }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Notes & Work Report -->
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light fw-bold border-bottom">
                            <i class="fas fa-clipboard-check text-gold me-2"></i> الملاحظات الفنية وتقرير العمل المنجز
                        </div>
                        <div class="card-body p-4">
                            @if($task->notes)
                                <div class="p-3 bg-light rounded border text-dark" style="font-size: 1.05rem; line-height: 1.8; white-space: pre-line;">
                                    {{ $task->notes }}
                                </div>
                            @else
                                <div class="text-center py-4 text-muted">
                                    <i class="fas fa-comment-slash fs-2 d-block mb-2"></i>
                                    لا توجد ملاحظات أو تقرير مسجل لهذا الأمر حتى الآن.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <!-- Signatures Section (Visible in Print & Bottom of Report) -->
            <div class="card shadow-sm border-0 mt-4 mt-print-5 print-signatures">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4 text-center border-bottom pb-2">
                        اعتمادات وتوقيعات الصيانة
                    </h6>
                    <div class="row text-center pt-2">
                        <div class="col-4">
                            <p class="fw-bold mb-1">المهندس المنفذ</p>
                            <p class="text-muted small mb-4">{{ $task->engineer->user->name ?? '........................' }}</p>
                            <p class="text-muted">التوقيع: ........................</p>
                        </div>
                        <div class="col-4">
                            <p class="fw-bold mb-1">مشرف قسم الصيانة</p>
                            <p class="text-muted small mb-4">........................</p>
                            <p class="text-muted">التوقيع: ........................</p>
                        </div>
                        <div class="col-4">
                            <p class="fw-bold mb-1">اعتماد مدير المصنع</p>
                            <p class="text-muted small mb-4">........................</p>
                            <p class="text-muted">التوقيع: ........................</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Include Status Update Modal -->
@include('tasks.partials.status_modal', ['task' => $task, 'engineers' => $engineers])

<style>
    @media print {
        body {
            background-color: #fff !important;
            font-size: 13px !important;
        }
        .navbar, .no-print, .btn, footer {
            display: none !important;
        }
        .card {
            border: 1px solid #ccc !important;
            box-shadow: none !important;
            break-inside: avoid;
        }
        .card-header {
            background-color: #f1f1f1 !important;
            color: #000 !important;
            -webkit-print-color-adjust: exact;
        }
        .bg-gold {
            background-color: #e2c055 !important;
            color: #000 !important;
            -webkit-print-color-adjust: exact;
        }
        .badge {
            border: 1px solid #000 !important;
            color: #000 !important;
            background-color: transparent !important;
        }
        @page {
            size: A4 portrait;
            margin: 15mm;
        }
    }
</style>

<script>
    function toggleCompletionDateField(selectElem, taskId) {
        const group = document.getElementById('completion_date_group_' + taskId);
        if (group) {
            if (selectElem.value === 'completed') {
                group.style.display = 'block';
            } else {
                group.style.display = 'none';
            }
        }
    }
</script>
@endsection
