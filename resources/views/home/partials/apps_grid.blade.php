<div class="mb-3 border-bottom pb-2">
    <h5 class="fw-bold text-dark"><i class="fas fa-th-large text-gold me-2"></i> التطبيقات الأساسية</h5>
</div>

<div class="row g-4 mb-5">
    
    @can('manage_factories')
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('factories.index') }}" class="text-decoration-none">
            <div class="card text-center border-0 shadow-sm h-100 app-card" style="background-color: #8e44ad; color: #fff;">
                <div class="card-body py-4 d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-industry fa-2x mb-3"></i>
                    <h6 class="fw-bold mb-0">المصانع</h6>
                </div>
            </div>
        </a>
    </div>
    @endcan

    @can('manage_machines')
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('machines.index') }}" class="text-decoration-none">
            <div class="card text-center border-0 shadow-sm h-100 app-card" style="background-color: #2980b9; color: #fff;">
                <div class="card-body py-4 d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-cogs fa-2x mb-3"></i>
                    <h6 class="fw-bold mb-0">الآلات</h6>
                </div>
            </div>
        </a>
    </div>
    @endcan

    @can('manage_engineers')
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('engineers.index') }}" class="text-decoration-none">
            <div class="card text-center border-0 shadow-sm h-100 app-card" style="background-color: #27ae60; color: #fff;">
                <div class="card-body py-4 d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-users-cog fa-2x mb-3"></i>
                    <h6 class="fw-bold mb-0">المهندسين</h6>
                </div>
            </div>
        </a>
    </div>
    @endcan

    @can('manage_tasks')
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('tasks.index') }}" class="text-decoration-none">
            <div class="card text-center border-0 shadow-sm h-100 app-card" style="background-color: #e67e22; color: #fff;">
                <div class="card-body py-4 d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-tools fa-2x mb-3"></i>
                    <h6 class="fw-bold mb-0">أوامر الصيانة</h6>
                </div>
            </div>
        </a>
    </div>
    @endcan

    @can('manage_catalogs')
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('catalogs.index') }}" class="text-decoration-none">
            <div class="card text-center border-0 shadow-sm h-100 app-card" style="background-color: #16a085; color: #fff;">
                <div class="card-body py-4 d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-list-check fa-2x mb-3"></i>
                    <h6 class="fw-bold mb-0">كتالوج المهام</h6>
                </div>
            </div>
        </a>
    </div>
    @endcan

    @can('manage_users')
    <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('users.index') }}" class="text-decoration-none">
            <div class="card text-center border-0 shadow-sm h-100 app-card" style="background-color: #c0392b; color: #fff;">
                <div class="card-body py-4 d-flex flex-column justify-content-center align-items-center">
                    <i class="fas fa-shield-alt fa-2x mb-3"></i>
                    <h6 class="fw-bold mb-0">إعدادات النظام</h6>
                </div>
            </div>
        </a>
    </div>
    @endcan

</div>

<style>
    .app-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border-radius: 0; /* Square-ish look like ERPs */
        border-bottom: 4px solid rgba(0,0,0,0.2) !important;
    }
    .app-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.2) !important;
        opacity: 0.95;
    }
</style>
