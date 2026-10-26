@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-11">
            
            <!-- Success / Error Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show fw-bold shadow-sm mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="alert alert-danger alert-dismissible fade show fw-bold shadow-sm mb-4" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> حدث خطأ أثناء الحفظ، يرجى مراجعة البيانات المدخلة.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Header Section -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                <div>
                    <h3 class="fw-bold mb-1 text-gold">
                        <i class="fas fa-tools me-2"></i> إدارة أوامر ومهام الصيانة
                    </h3>
                    <p class="text-muted small mb-0">متابعة وتحديث حالات أوامر العمل وجدولة الصيانة الوقائية والتصحيحية</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('reports.engineers') }}" target="_blank" class="btn btn-outline-dark fw-bold px-3" title="طباعة تقرير مهام المهندسين">
                        <i class="fas fa-print me-1"></i> تقرير المهام
                    </a>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary fw-bold px-4">
                        <i class="fas fa-plus-circle me-1"></i> إصدار أمر صيانة جديد
                    </a>
                </div>
            </div>

            <!-- Stats Overview Cards -->
            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <a href="{{ route('tasks.index') }}" class="text-decoration-none">
                        <div class="card shadow-sm border-0 border-start border-4 border-primary h-100 hover-card">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="text-muted small fw-bold d-block">إجمالي الأوامر</span>
                                        <span class="fs-4 fw-bold text-dark">{{ $stats['total'] }}</span>
                                    </div>
                                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle">
                                        <i class="fas fa-clipboard-list fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ route('tasks.index', ['status' => 'pending']) }}" class="text-decoration-none">
                        <div class="card shadow-sm border-0 border-start border-4 border-secondary h-100 hover-card {{ request('status') == 'pending' ? 'bg-light border-2 border-dark' : '' }}">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="text-muted small fw-bold d-block">قيد الانتظار</span>
                                        <span class="fs-4 fw-bold text-secondary">{{ $stats['pending'] }}</span>
                                    </div>
                                    <div class="bg-secondary bg-opacity-10 text-secondary p-3 rounded-circle">
                                        <i class="fas fa-clock fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ route('tasks.index', ['status' => 'in_progress']) }}" class="text-decoration-none">
                        <div class="card shadow-sm border-0 border-start border-4 border-warning h-100 hover-card {{ request('status') == 'in_progress' ? 'bg-light border-2 border-dark' : '' }}">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="text-muted small fw-bold d-block">جاري العمل</span>
                                        <span class="fs-4 fw-bold text-warning text-dark">{{ $stats['in_progress'] }}</span>
                                    </div>
                                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-circle">
                                        <i class="fas fa-wrench fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3">
                    <a href="{{ route('tasks.index', ['status' => 'completed']) }}" class="text-decoration-none">
                        <div class="card shadow-sm border-0 border-start border-4 border-success h-100 hover-card {{ request('status') == 'completed' ? 'bg-light border-2 border-dark' : '' }}">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="text-muted small fw-bold d-block">مكتمل ومُنجز</span>
                                        <span class="fs-4 fw-bold text-success">{{ $stats['completed'] }}</span>
                                    </div>
                                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle">
                                        <i class="fas fa-check-circle fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Filter & Search Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-3">
                    <form action="{{ route('tasks.index') }}" method="GET" class="row g-2 align-items-center">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control" placeholder="بحث برقم الأمر، الآلة، المهندس، الملاحظات..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="status" class="form-select">
                                <option value="">-- كل الحالات --</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ قيد الانتظار</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>⚙️ جاري العمل</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✅ مكتمل</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="category" class="form-select">
                                <option value="">-- كل التخصصات --</option>
                                <option value="mechanical" {{ request('category') == 'mechanical' ? 'selected' : '' }}>ميكانيكا (Mechanical)</option>
                                <option value="electrical" {{ request('category') == 'electrical' ? 'selected' : '' }}>كهرباء (Electrical)</option>
                                <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>عام</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-outline-dark fw-bold w-100">
                                تصفية
                            </button>
                            @if(request()->anyFilled(['search', 'status', 'category', 'type']))
                                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary" title="إلغاء التصفية">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Work Orders Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 text-center">
                            <thead class="bg-gold text-white">
                                <tr>
                                    <th class="py-3 px-3">رقم الأمر</th>
                                    <th class="py-3 px-3 text-start">الآلة / المعدة</th>
                                    <th class="py-3 px-3">التخصص</th>
                                    <th class="py-3 px-3">نوع الصيانة</th>
                                    <th class="py-3 px-3">المهندس المكلف</th>
                                    <th class="py-3 px-3">تاريخ الجدولة</th>
                                    <th class="py-3 px-3">الحالة</th>
                                    <th class="py-3 px-3 text-center">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $task)
                                <tr>
                                    <td class="py-3 px-3 fw-bold">
                                        <a href="{{ route('tasks.show', $task->id) }}" class="text-decoration-none text-dark fw-bold">
                                            #{{ $task->id }}
                                        </a>
                                    </td>
                                    
                                    <td class="py-3 px-3 text-start">
                                        <span class="fw-bold text-primary" dir="ltr">{{ $task->machine->serial_number ?? 'غير محدد' }}</span>
                                        <div class="small fw-semibold text-dark">{{ $task->machine->name ?? '' }}</div>
                                        @if($task->machine && $task->machine->factory)
                                            <span class="badge bg-light text-muted border small">{{ $task->machine->factory->name }}</span>
                                        @endif
                                    </td>
                                    
                                    <td class="py-3 px-3 fw-bold">
                                        @if($task->category == 'mechanical')
                                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-2 py-1">
                                                <i class="fas fa-cogs me-1"></i> ميكانيكا
                                            </span>
                                        @elseif($task->category == 'electrical')
                                            <span class="badge bg-warning bg-opacity-10 text-warning text-dark border border-warning px-2 py-1">
                                                <i class="fas fa-bolt me-1"></i> كهرباء
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary px-2 py-1">
                                                <i class="fas fa-tools me-1"></i> عام
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <td class="py-3 px-3">
                                        @if($task->type == 'preventive')
                                            <span class="badge bg-info text-dark">وقائية</span>
                                        @else
                                            <span class="badge bg-danger">تصحيحية</span>
                                        @endif
                                        
                                        @if($task->catalog)
                                            <div class="mt-1 small text-muted" dir="ltr" title="{{ $task->catalog->description }}">
                                                <i class="fas fa-list-check text-secondary"></i> {{ $task->catalog->code }}
                                            </div>
                                        @endif
                                    </td>
                                    
                                    <td class="py-3 px-3">
                                        @if($task->engineer && $task->engineer->user)
                                            <span class="fw-bold text-dark">
                                                <i class="fas fa-user-circle text-muted me-1"></i>
                                                {{ $task->engineer->user->name }}
                                            </span>
                                        @else
                                            <span class="text-muted small fst-italic">غير محدد</span>
                                        @endif
                                    </td>
                                    
                                    <td class="py-3 px-3" dir="ltr">
                                        <span class="small fw-bold">
                                            {{ $task->scheduled_date ? $task->scheduled_date->format('Y-m-d') : '---' }}
                                        </span>
                                        @if($task->completion_date)
                                            <div class="small text-success mt-1" title="تاريخ الإنجاز">
                                                <i class="fas fa-check"></i> {{ $task->completion_date->format('Y-m-d') }}
                                            </div>
                                        @endif
                                    </td>
                                    
                                    <td class="py-3 px-3">
                                        @if($task->status == 'pending')
                                            <span class="badge bg-secondary px-2 py-1">
                                                <i class="fas fa-clock me-1"></i> قيد الانتظار
                                            </span>
                                        @elseif($task->status == 'in_progress')
                                            <span class="badge bg-warning text-dark px-2 py-1">
                                                <i class="fas fa-wrench me-1"></i> جاري العمل
                                            </span>
                                        @elseif($task->status == 'completed')
                                            <span class="badge bg-success px-2 py-1">
                                                <i class="fas fa-check-circle me-1"></i> مكتمل
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <td class="py-3 px-3 text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <!-- View Details Modal Button -->
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailsModal-{{ $task->id }}" title="عرض سريع للتفاصيل">
                                                <i class="fas fa-eye"></i> التفاصيل
                                            </button>

                                            <!-- Update Status Modal Button -->
                                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#statusModal-{{ $task->id }}" title="تحديث حالة الأمر">
                                                <i class="fas fa-sync-alt"></i> تحديث الحالة
                                            </button>

                                            <!-- Full Page Link Button -->
                                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-outline-secondary" title="فتح صفحة الأمر كاملة والطباعة">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-tools fs-1 d-block mb-3 text-gold"></i>
                                        لا توجد أوامر صيانة مطابقة حالياً.
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

<!-- Render Modals for Each Task -->
@foreach($tasks as $task)
    @include('tasks.partials.details_modal', ['task' => $task])
    @include('tasks.partials.status_modal', ['task' => $task, 'engineers' => $engineers])
@endforeach

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
