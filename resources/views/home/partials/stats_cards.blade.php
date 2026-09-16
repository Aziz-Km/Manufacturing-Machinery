<!-- الإحصائيات العلوية -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body text-center">
                <h5 class="text-muted fw-bold mb-2">إجمالي الآلات</h5>
                <h2 class="fw-bold text-dark mb-0">{{ $stats['total_machines'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-success text-white">
            <div class="card-body text-center">
                <h5 class="fw-bold mb-2">آلات تعمل</h5>
                <h2 class="fw-bold mb-0">{{ $stats['active_machines'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-warning text-dark">
            <div class="card-body text-center">
                <h5 class="fw-bold mb-2">في الصيانة</h5>
                <h2 class="fw-bold mb-0">{{ $stats['maintenance_machines'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 bg-danger text-white">
            <div class="card-body text-center">
                <h5 class="fw-bold mb-2">آلات متوقفة</h5>
                <h2 class="fw-bold mb-0">{{ $stats['stopped_machines'] }}</h2>
            </div>
        </div>
    </div>
</div>
