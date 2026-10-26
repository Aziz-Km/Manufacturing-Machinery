@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <!-- Header with Gold Accent and Logo -->
                <div class="card-header bg-white border-0 pt-4 pb-3 text-center">
                    <img src="{{ asset('logo.png') }}" alt="شعار شركة الجوف" style="height: 70px; width: auto; object-fit: contain;" class="mb-3">
                    <h4 class="fw-bold text-dark mb-1">منظومة الصيانة المصانع</h4>
                    <p class="text-muted small mb-0">شركة الجوف للتقنية النفطية - تسجيل الدخول</p>
                    <div class="mt-3 mx-auto" style="width: 60px; height: 3px; background-color: #d4af37; border-radius: 2px;"></div>
                </div>

                <div class="card-body p-4 p-md-5 pt-2">
                    @if (session('status'))
                        <div class="alert alert-success fw-bold text-center" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <!-- Identifier (Employee ID, Email, or Name) -->
                        <div class="mb-4">
                            <label for="login" class="form-label fw-bold text-dark">
                                <i class="fas fa-id-card text-gold me-1"></i> الرقم الوظيفي أو البريد أو اسم المستخدم
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input id="login" type="text" 
                                       class="form-control form-control-lg border-start-0 @error('login') is-invalid @enderror @error('email') is-invalid @enderror" 
                                       name="login" 
                                       value="{{ old('login') ?? old('email') }}" 
                                       required 
                                       autocomplete="username" 
                                       autofocus 
                                       dir="ltr"
                                       style="direction: ltr; text-align: right;"
                                       placeholder="أدخل الرقم الوظيفي (2830) أو البريد">
                            </div>
                            @error('login')
                                <div class="text-danger small mt-2 fw-bold">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                            @error('email')
                                <div class="text-danger small mt-2 fw-bold">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                            <div class="alert alert-warning py-2 px-3 mt-2 border-0 rounded-3 small">
                                <i class="fas fa-lightbulb text-warning me-1"></i>
                                <strong>تنبيه للمهندسين:</strong> يمكنك كتابة <strong>الرقم الوظيفي فقط</strong> (مثل: <code>2830</code>) دون الحاجة لكتابة <code>@jowfe.com</code>.
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label fw-bold text-dark mb-0">
                                    <i class="fas fa-lock text-gold me-1"></i> كلمة المرور
                                </label>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none small text-muted" href="{{ route('password.request') }}">
                                        نسيت كلمة المرور؟
                                    </a>
                                @endif
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-key text-muted"></i>
                                </span>
                                <input id="password" type="password" 
                                       class="form-control form-control-lg border-start-0 border-end-0 @error('password') is-invalid @enderror" 
                                       name="password" 
                                       required 
                                       autocomplete="off"
                                       dir="ltr"
                                       style="direction: ltr; text-align: right;"
                                       placeholder="أدخل كلمة المرور">
                                <button type="button" class="input-group-text bg-light border-start-0" id="togglePasswordBtn" style="cursor: pointer;" title="إظهار / إخفاء كلمة المرور">
                                    <i class="fas fa-eye text-muted" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-2 fw-bold">
                                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted user-select-none" for="remember">
                                تذكر تسجيل دخولي على هذا الجهاز
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm py-2" style="background-color: #d4af37; border-color: #d4af37;">
                                <i class="fas fa-sign-in-alt me-2"></i> تسجيل الدخول
                            </button>
                        </div>
                    </form>

                    <!-- Support Card Note -->
                    <div class="p-3 mt-4 rounded-3 text-center border" style="background-color: #fdfbf7;">
                        <small class="text-muted d-block">
                            <i class="fas fa-info-circle text-gold me-1"></i>
                            إذا واجهت أي صعوبة في الدخول، يرجى مراجعة مدير النظام لإعادة ضبط كلمة المرور أو تحديث بيانات الحساب.
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        if (toggleBtn && passwordInput && toggleIcon) {
            toggleBtn.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            });
        }
    });
</script>
@endsection
