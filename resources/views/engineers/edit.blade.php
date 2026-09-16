@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark text-center py-3">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-user-edit me-2"></i> تعديل بيانات المهندس</h4>
                </div>
                
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('engineers.update', $engineer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">الاسم الرباعي</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name', $engineer->user->name) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="employee_id" class="form-label fw-bold">الرقم الوظيفي</label>
                            <input type="text" class="form-control form-control-lg" id="employee_id" name="employee_id" value="{{ old('employee_id', $engineer->employee_id) }}" required dir="ltr">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">البريد الإلكتروني</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email', $engineer->user->email) }}" required dir="ltr">
                        </div>

                        <div class="mb-4">
                            <label for="specialization" class="form-label fw-bold">التخصص (Specialization)</label>
                            <select class="form-select form-select-lg" id="specialization" name="specialization" required>
                                <option value="mechanical" {{ (old('specialization', $engineer->specialization) == 'mechanical') ? 'selected' : '' }}>ميكانيكا (Mechanical)</option>
                                <option value="electrical" {{ (old('specialization', $engineer->specialization) == 'electrical') ? 'selected' : '' }}>كهرباء (Electrical)</option>
                                <option value="general" {{ (old('specialization', $engineer->specialization) == 'general') ? 'selected' : '' }}>عام / أخرى</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-lg fw-bold">
                                <i class="fas fa-save me-2"></i> تحديث البيانات
                            </button>
                            <a href="{{ route('engineers.index') }}" class="btn btn-outline-secondary btn-lg fw-bold">
                                إلغاء والعودة
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
