@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-gold text-white text-center py-3">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-user-plus me-2"></i> إضافة مهندس جديد</h4>
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

                    <form action="{{ route('engineers.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">الاسم الرباعي</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name" required placeholder="مثال: أحمد محمد علي حسن">
                        </div>

                        <div class="mb-4">
                            <label for="employee_id" class="form-label fw-bold">الرقم الوظيفي</label>
                            <input type="text" class="form-control form-control-lg" id="employee_id" name="employee_id" required placeholder="مثال: 12345" dir="ltr">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">البريد الإلكتروني للمهندس</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" required placeholder="مثال: engineer@jowfe.com" dir="ltr">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label fw-bold">كلمة المرور</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" required dir="ltr">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation" class="form-label fw-bold">تأكيد كلمة المرور</label>
                                <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" required dir="ltr">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="specialization" class="form-label fw-bold">التخصص (Specialization)</label>
                            <select class="form-select form-select-lg" id="specialization" name="specialization" required>
                                <option value="" disabled selected>-- اختر تخصص المهندس --</option>
                                <option value="mechanical">ميكانيكا (Mechanical)</option>
                                <option value="electrical">كهرباء (Electrical)</option>
                                <option value="general">عام / أخرى</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                <i class="fas fa-save me-2"></i> حفظ المهندس وإنشاء الحساب
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
