@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-11">
            
            <!-- Header & Actions -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1 text-gold">
                        <i class="fas fa-user-cog me-2"></i> ملف المهندس ومهام الصيانة
                    </h3>
                    <p class="text-muted small mb-0">عرض كافة البيانات وسجل المهام الموكلة للمهندس</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('engineers.index') }}" class="btn btn-outline-secondary fw-bold px-3">
                        <i class="fas fa-arrow-right me-1"></i> العودة للمهندسين
                    </a>
                    <a href="{{ route('reports.engineers', ['engineer_id' => $engineer->id]) }}" target="_blank" class="btn btn-outline-dark fw-bold px-3" title="طباعة تقرير مهام المهندس">
                        <i class="fas fa-print me-1"></i> طباعة تقرير المهام
                    </a>
                    <a href="{{ route('engineers.edit', $engineer->id) }}" class="btn btn-warning fw-bold px-3">
                        <i class="fas fa-edit me-1"></i> تعديل البيانات
                    </a>
                </div>
            </div>

            <!-- Profile & Stats Cards -->
            <div class="row g-4 mb-4">
                
                <!-- Engineer Profile Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-gold text-white fw-bold">
                            <i class="fas fa-id-card me-2"></i> البيانات الشخصية والمهنية
                        </div>
                        <div class="card-body p-4">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <th class="text-muted" style="width: 35%;">الاسم الكامل:</th>
                                    <td class="fw-bold fs-5 text-dark">{{ $engineer->user->name ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">الرقم الوظيفي:</th>
                                    <td class="fw-bold text-primary fs-6">{{ $engineer->employee_id ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">البريد الإلكتروني:</th>
                                    <td dir="ltr" class="text-end fw-semibold">{{ $engineer->user->email ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">التخصص:</th>
                                    <td>
                                        <span class="badge bg-info text-dark fs-6">{{ $engineer->specialization ?? 'عام' }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Task Metrics Card -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-light fw-bold text-dark border-bottom">
                            <i class="fas fa-chart-pie text-gold me-2"></i> إحصائيات المهام الموكلة
                        </div>
                        <div class="card-body p-4 d-flex align-items-center">
                            <div class="row g-3 w-100 text-center">
                                <div class="col-6 col-md-3">
                                    <div class="p-3 bg-light rounded border">
                                        <span class="text-muted small d-block mb-1">الإجمالي</span>
                                        <span class="fs-4 fw-bold text-dark">{{ $engineer->tasks->count() }}</span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="p-3 bg-secondary bg-opacity-10 rounded border border-secondary">
                                        <span class="text-secondary small d-block mb-1">قيد الانتظار</span>
                                        <span class="fs-4 fw-bold text-secondary">{{ $engineer->tasks->where('status', 'pending')->count() }}</span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="p-3 bg-warning bg-opacity-10 rounded border border-warning">
                                        <span class="text-warning text-dark small d-block mb-1">جاري العمل</span>
                                        <span class="fs-4 fw-bold text-warning text-dark">{{ $engineer->tasks->where('status', 'in_progress')->count() }}</span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="p-3 bg-success bg-opacity-10 rounded border border-success">
                                        <span class="text-success small d-block mb-1">مكتملة</span>
                                        <span class="fs-4 fw-bold text-success">{{ $engineer->tasks->where('status', 'completed')->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Tasks Table -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-clipboard-list text-primary me-2"></i> قائمة أوامر الصيانة المسندة
                    </h5>
                    <a href="{{ route('reports.engineers', ['engineer_id' => $engineer->id]) }}" target="_blank" class="btn btn-sm btn-outline-dark fw-bold">
                        <i class="fas fa-print me-1"></i> طباعة هذه القائمة
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 text-center">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-3 px-3">رقم الأمر</th>
                                    <th class="py-3 px-3 text-start">الآلة المستهدفة</th>
                                    <th class="py-3 px-3">التخصص</th>
                                    <th class="py-3 px-3">نوع الصيانة</th>
                                    <th class="py-3 px-3">المهمة / الكتالوج</th>
                                    <th class="py-3 px-3">تاريخ الجدولة</th>
                                    <th class="py-3 px-3">تاريخ الإنجاز</th>
                                    <th class="py-3 px-3">الحالة</th>
                                    <th class="py-3 px-3 text-center">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($engineer->tasks as $task)
                                <tr>
                                    <td class="py-3 px-3 fw-bold">#{{ $task->id }}</td>
                                    
                                    <td class="py-3 px-3 text-start">
                                        <span class="fw-bold text-primary" dir="ltr">{{ $task->machine->serial_number ?? 'غير محدد' }}</span>
                                        <div class="small text-muted">{{ $task->machine->name ?? '' }}</div>
                                        @if($task->machine && $task->machine->factory)
                                            <span class="badge bg-light text-muted border small">{{ $task->machine->factory->name }}</span>
                                        @endif
                                    </td>

                                    <td class="py-3 px-3">
                                        @if($task->category == 'mechanical')
                                            <span class="badge bg-primary">ميكانيكا</span>
                                        @elseif($task->category == 'electrical')
                                            <span class="badge bg-warning text-dark">كهرباء</span>
                                        @else
                                            <span class="badge bg-secondary">عام</span>
                                        @endif
                                    </td>

                                    <td class="py-3 px-3">
                                        @if($task->type == 'preventive')
                                            <span class="badge bg-info text-dark">وقائية</span>
                                        @else
                                            <span class="badge bg-danger">تصحيحية</span>
                                        @endif
                                    </td>

                                    <td class="py-3 px-3 text-start">
                                        @if($task->catalog)
                                            <div class="small fw-bold" dir="ltr">[{{ $task->catalog->code }}]</div>
                                            <div class="small text-muted" dir="ltr">{{ Str::limit($task->catalog->description, 35) }}</div>
                                        @else
                                            <span class="text-muted small">{{ Str::limit($task->notes ?? 'إدخال يدوي', 35) }}</span>
                                        @endif
                                    </td>

                                    <td class="py-3 px-3" dir="ltr">
                                        {{ $task->scheduled_date ? $task->scheduled_date->format('Y-m-d') : '---' }}
                                    </td>

                                    <td class="py-3 px-3" dir="ltr">
                                        {{ $task->completion_date ? $task->completion_date->format('Y-m-d') : '---' }}
                                    </td>

                                    <td class="py-3 px-3">
                                        @if($task->status == 'pending')
                                            <span class="badge bg-secondary">قيد الانتظار</span>
                                        @elseif($task->status == 'in_progress')
                                            <span class="badge bg-warning text-dark">جاري العمل</span>
                                        @elseif($task->status == 'completed')
                                            <span class="badge bg-success">مكتمل</span>
                                        @endif
                                    </td>

                                    <td class="py-3 px-3 text-center">
                                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-outline-primary" title="عرض تفاصيل أمر الصيانة">
                                            <i class="fas fa-eye me-1"></i> التفاصيل
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="fas fa-clipboard-check fs-1 d-block mb-3 text-gold"></i>
                                        لا توجد مهام صيانة موكلة لهذا المهندس حالياً.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
