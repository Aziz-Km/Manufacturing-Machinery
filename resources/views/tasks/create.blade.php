@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gold text-white fw-bold">
                    <i class="fas fa-clipboard-list me-2"></i> إصدار أمر صيانة جديد
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="machine_id" class="form-label fw-bold">الآلة أو المعدة المستهدفة</label>
                            <select class="form-select" id="machine_id" name="machine_id" required>
                                <option value="" disabled selected>اختر الآلة...</option>
                                @foreach($machines as $machine)
                                    <option value="{{ $machine->id }}">[{{ $machine->serial_number }}] - {{ $machine->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="task_catalog_id" class="form-label fw-bold">اختر المهمة القياسية (اختياري)</label>
                            <select class="form-select" id="task_catalog_id" name="task_catalog_id">
                                <option value="" selected>-- لا يوجد (إدخال يدوي) --</option>
                                @foreach($catalogs as $catalog)
                                    <option value="{{ $catalog->id }}">{{ $catalog->code }} - {{ $catalog->description }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">هذه القائمة مأخوذة من كتالوج المهام القياسية (مثل مهام الميكانيكا).</small>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label fw-bold">تصنيف المهمة (التخصص)</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="" disabled selected>اختر تخصص الصيانة...</option>
                                <option value="mechanical">ميكانيكا (Mechanical)</option>
                                <option value="electrical">كهرباء (Electrical)</option>
                                <option value="general">عام / أخرى</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label fw-bold">نوع الصيانة</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="" disabled selected>اختر نوع الصيانة...</option>
                                <option value="preventive">صيانة وقائية (دورية)</option>
                                <option value="corrective">صيانة تصحيحية (طارئة/إصلاح عطل)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="engineer_id" class="form-label fw-bold">المهندس المكلف (اختياري)</label>
                            <select class="form-select" id="engineer_id" name="engineer_id">
                                <option value="" selected>لم يحدد بعد (سيتم التكليف لاحقاً)</option>
                                @foreach($engineers as $engineer)
                                    <option value="{{ $engineer->id }}">{{ $engineer->user->name ?? 'مهندس' }} - {{ $engineer->specialization }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="scheduled_date" class="form-label fw-bold">تاريخ الجدولة / بدء العمل</label>
                            <input type="date" class="form-control" id="scheduled_date" name="scheduled_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label fw-bold">ملاحظات أو وصف العطل</label>
                            <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="اكتب تفاصيل العطل أو ما يجب صيانته..."></textarea>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary me-2">إلغاء</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4">إصدار وتأكيد الأمر</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
