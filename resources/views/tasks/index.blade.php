@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0 text-gold">
                    <i class="fas fa-tools me-2"></i> أوامر ومهام الصيانة
                </h3>
                <div class="text-start">
                    <a href="{{ route('reports.engineers') }}" target="_blank" class="btn btn-outline-dark fw-bold px-3 me-2" title="طباعة تقرير مهام المهندسين">
                        <i class="fas fa-print"></i> طباعة
                    </a>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary fw-bold px-4">
                        إصدار أمر صيانة جديد
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-center">
                            <thead class="bg-gold text-white">
                                <tr>
                                    <th class="py-3 px-4">رقم الأمر</th>
                                    <th class="py-3 px-4">الآلة / المعدة</th>
                                    <th class="py-3 px-4">التخصص</th>
                                    <th class="py-3 px-4">نوع الصيانة</th>
                                    <th class="py-3 px-4">المهندس المكلف</th>
                                    <th class="py-3 px-4">تاريخ الجدولة</th>
                                    <th class="py-3 px-4">الحالة</th>
                                    <th class="py-3 px-4 text-center">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $task)
                                <tr>
                                    <td class="py-3 px-4 fw-bold">#{{ $task->id }}</td>
                                    <td class="py-3 px-4 fw-bold" style="text-align: right;" dir="ltr">
                                        {{ $task->machine->serial_number ?? 'غير محدد' }}
                                        <div class="small text-muted">{{ $task->machine->name ?? '' }}</div>
                                    </td>
                                    <td class="py-3 px-4 fw-bold">
                                        @if($task->category == 'mechanical')
                                            <span class="text-primary"><i class="fas fa-cogs"></i> ميكانيكا</span>
                                        @elseif($task->category == 'electrical')
                                            <span class="text-warning text-dark"><i class="fas fa-bolt"></i> كهرباء</span>
                                        @else
                                            <span class="text-secondary"><i class="fas fa-tools"></i> عام</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        @if($task->type == 'preventive')
                                            <span class="badge bg-info">وقائية</span>
                                        @else
                                            <span class="badge bg-danger">تصحيحية</span>
                                        @endif
                                        
                                        @if($task->catalog)
                                            <div class="mt-1 small fw-bold text-secondary">
                                                <i class="fas fa-list-check"></i> {{ $task->catalog->code }}: {{ $task->catalog->description }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        {{ $task->engineer->user->name ?? 'غير محدد' }}
                                    </td>
                                    <td class="py-3 px-4" dir="ltr">
                                        {{ \Carbon\Carbon::parse($task->scheduled_date)->format('Y-m-d') }}
                                    </td>
                                    <td class="py-3 px-4">
                                        @if($task->status == 'pending')
                                            <span class="badge bg-secondary">قيد الانتظار</span>
                                        @elseif($task->status == 'in_progress')
                                            <span class="badge bg-warning text-dark">جاري العمل</span>
                                        @elseif($task->status == 'completed')
                                            <span class="badge bg-success">مكتمل</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <button class="btn btn-sm btn-outline-primary">عرض التفاصيل</button>
                                        <button class="btn btn-sm btn-outline-success">تحديث الحالة</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        لا توجد أوامر صيانة مسجلة حالياً.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($tasks->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $tasks->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
