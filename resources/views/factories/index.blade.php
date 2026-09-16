@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0 text-gold">
                    <i class="fas fa-industry me-2"></i> المصانع
                </h3>
            </div>

            <div class="row row-cols-1 row-cols-md-2 g-4">
                @forelse($factories as $factory)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 hover-shadow transition">
                        <div class="card-body text-center p-5">
                            <div class="mb-4">
                                <i class="fas fa-building text-gold" style="font-size: 4rem;"></i>
                            </div>
                            <h2 class="card-title fw-bold mb-3" dir="ltr">{{ $factory->name }}</h2>
                            <p class="card-text text-muted mb-4">
                                <i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $factory->location ?? 'غير محدد' }}
                            </p>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="{{ route('factories.show', $factory->id) }}" class="btn btn-primary fw-bold px-4">
                                    <i class="fas fa-cog me-1"></i> عرض الآلات
                                    <span class="badge bg-white text-dark ms-2">{{ $factory->machines_count }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-building-slash fs-1 d-block mb-3"></i>
                        لا توجد مصانع مسجلة حالياً.
                    </div>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-5px);
    }
    .transition {
        transition: all 0.3s ease-in-out;
    }
</style>
@endsection
