<!-- ملخص إضافي -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-gold text-white fw-bold py-3">
        <i class="fas fa-info-circle me-2"></i> ملخص المهام
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                مهام قيد الانتظار
                <span class="badge bg-secondary rounded-pill">{{ $stats['pending_tasks'] }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                مهام جاري العمل عليها
                <span class="badge bg-warning text-dark rounded-pill">{{ $stats['in_progress_tasks'] }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                مهام مكتملة
                <span class="badge bg-success rounded-pill">{{ $stats['completed_tasks'] }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center border-bottom-0">
                <strong>إجمالي المهندسين</strong>
                <span class="badge bg-primary rounded-pill">{{ $stats['total_engineers'] }}</span>
            </li>
        </ul>
    </div>
</div>
