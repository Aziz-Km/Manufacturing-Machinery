<!-- أوامر الصيانة -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center py-3">
        <span><i class="fas fa-tools text-gold me-2"></i> أحدث أوامر الصيانة</span>
        <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-primary">عرض الكل</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th>رقم الأمر</th>
                        <th>الآلة</th>
                        <th>النوع</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_tasks as $task)
                    <tr>
                        <td class="fw-bold">#{{ $task->id }}</td>
                        <td dir="ltr">{{ $task->machine->serial_number ?? 'N/A' }}</td>
                        <td>
                            @if($task->type == 'preventive')
                                <span class="badge bg-info text-dark">وقائية</span>
                            @else
                                <span class="badge bg-danger">تصحيحية</span>
                            @endif
                        </td>
                        <td>
                            @if($task->status == 'pending')
                                <span class="badge bg-secondary">قيد الانتظار</span>
                            @elseif($task->status == 'in_progress')
                                <span class="badge bg-warning text-dark">جاري العمل</span>
                            @elseif($task->status == 'completed')
                                <span class="badge bg-success">مكتمل</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-3 text-muted">لا يوجد أوامر صيانة حالياً</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
