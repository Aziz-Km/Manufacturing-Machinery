@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gold text-white fw-bold">
                    <i class="fas fa-plus-circle me-2"></i> إضافة آلة جديدة
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('machines.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="serial_number" class="form-label fw-bold">رقم الآلة (Tag/Serial Number)</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">اسم الآلة</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="factory_id" class="form-label fw-bold">المنطقة / المصنع</label>
                                <select class="form-select" id="factory_id" name="factory_id" required>
                                    <option value="" disabled selected>اختر المصنع...</option>
                                    @foreach(\App\Models\Factory::all() as $factory)
                                        <option value="{{ $factory->id }}">{{ $factory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="production_line" class="form-label fw-bold">خط الإنتاج / التصنيف</label>
                                <select class="form-select" id="production_line" name="production_line">
                                    <option value="" selected>بدون تصنيف (عام)</option>
                                    <option value="خط البينتونايت">خط البينتونايت (Bentonite)</option>
                                    <option value="خط البرايت">خط البرايت (Barite)</option>
                                </select>
                                <small class="text-muted">مخصص لمصنع GPP بشكل أساسي</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="type" class="form-label fw-bold">نوع الآلة</label>
                                <input type="text" class="form-control" id="type" name="type" placeholder="مثال: مضخة، مولد...">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="total_operating_hours" class="form-label fw-bold">ساعات التشغيل الحالية</label>
                                <input type="number" class="form-control" id="total_operating_hours" name="total_operating_hours" value="0" min="0">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('machines.index') }}" class="btn btn-secondary me-2">إلغاء</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4">حفظ الآلة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
