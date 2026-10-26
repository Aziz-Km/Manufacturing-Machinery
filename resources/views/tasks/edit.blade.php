@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gold text-white fw-bold d-flex justify-content-between align-items-center">
                    <span>
                        <i class="fas fa-edit me-2"></i> تعديل أمر الصيانة #{{ $task->id }}
                    </span>
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-outline-light">
                        عرض التفاصيل
                    </a>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="machine_id" class="form-label fw-bold">الآلة أو المعدة المستهدفة</label>
                            <select class="form-select" id="machine_id" name="machine_id" required>
                                @foreach($machines as $machine)
                                    <option value="{{ $machine->id }}" {{ $task->machine_id == $machine->id ? 'selected' : '' }}>
                                        [{{ $machine->serial_number }}] - {{ $machine->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="task_catalog_id" class="form-label fw-bold">المهمة القياسية (اختياري)</label>
                            <select class="form-select" id="task_catalog_id" name="task_catalog_id">
                                <option value="" {{ !$task->task_catalog_id ? 'selected' : '' }}>-- لا يوجد (إدخال يدوي) --</option>
                                @foreach($catalogs as $catalog)
                                    <option value="{{ $catalog->id }}" {{ $task->task_catalog_id == $catalog->id ? 'selected' : '' }}>
                                        {{ $catalog->code }} - {{ $catalog->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="category" class="form-label fw-bold">التخصص</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="mechanical" {{ $task->category == 'mechanical' ? 'selected' : '' }}>ميكانيكا (Mechanical)</option>
                                    <option value="electrical" {{ $task->category == 'electrical' ? 'selected' : '' }}>كهرباء (Electrical)</option>
                                    <option value="general" {{ $task->category == 'general' ? 'selected' : '' }}>عام</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="type" class="form-label fw-bold">نوع الصيانة</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="preventive" {{ $task->type == 'preventive' ? 'selected' : '' }}>صيانة وقائية (دورية)</option>
                                    <option value="corrective" {{ $task->type == 'corrective' ? 'selected' : '' }}>صيانة تصحيحية (طارئة/إصلاح عطل)</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-bold">حالة الأمر</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>جاري العمل</option>
                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="engineer_id" class="form-label fw-bold">المهندس المكلف</label>
                                <select class="form-select" id="engineer_id" name="engineer_id">
                                    <option value="">-- لم يحدد بعد --</option>
                                    @foreach($engineers as $engineer)
                                        <option value="{{ $engineer->id }}" {{ $task->engineer_id == $engineer->id ? 'selected' : '' }}>
                                            {{ $engineer->user->name ?? 'مهندس' }} - {{ $engineer->specialization }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="scheduled_date" class="form-label fw-bold">تاريخ الجدولة</label>
                                <input type="date" class="form-control" id="scheduled_date" name="scheduled_date" value="{{ $task->scheduled_date ? $task->scheduled_date->format('Y-m-d') : '' }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="completion_date" class="form-label fw-bold">تاريخ الإنجاز (إذا اكتمل)</label>
                                <input type="date" class="form-control" id="completion_date" name="completion_date" value="{{ $task->completion_date ? $task->completion_date->format('Y-m-d') : '' }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label fw-bold">ملاحظات وتقرير العمل</label>
                            <textarea class="form-control" id="notes" name="notes" rows="4">{{ $task->notes }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">إلغاء والعودة</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4">حفظ التعديلات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
