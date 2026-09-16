@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0 text-gold">
                    <i class="fas fa-shield-alt me-2"></i> لوحة تحكم الصلاحيات والمستخدمين
                </h3>
                <button type="button" class="btn btn-primary fw-bold px-4" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-user-plus me-1"></i> إضافة مستخدم جديد
                </button>
            </div>

            @include('users.partials.add_user_modal')

            @if(session('success'))
                <div class="alert alert-success fw-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-center align-middle">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th class="py-3 px-4">اسم المستخدم</th>
                                    <th class="py-3 px-4">البريد الإلكتروني</th>
                                    <th class="py-3 px-4">الدور الحالي (Role)</th>
                                    <th class="py-3 px-4 text-center">تحديث الصلاحية</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td class="py-3 px-4 fw-bold">{{ $user->name }}</td>
                                    <td class="py-3 px-4" dir="ltr">{{ $user->email }}</td>
                                    <td class="py-3 px-4">
                                        @if($user->hasRole('Admin'))
                                            <span class="badge bg-danger">مدير نظام (Admin)</span>
                                        @elseif($user->hasRole('Engineer'))
                                            <span class="badge bg-primary">مهندس (Engineer)</span>
                                        @else
                                            <span class="badge bg-secondary">مشاهد (Viewer)</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <form action="{{ route('users.updateRole', $user->id) }}" method="POST" class="d-flex m-0">
                                                @csrf
                                                @method('PUT')
                                                <select name="role" class="form-select form-select-sm w-auto me-2" required>
                                                    <option value="" disabled selected>اختر الدور...</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-outline-success fw-bold">تحديث</button>
                                            </form>
                                            
                                            <!-- Permissions & Reset Password Buttons -->
                                            <button type="button" class="btn btn-sm btn-primary me-1 fw-bold" data-bs-toggle="modal" data-bs-target="#permissionsModal-{{ $user->id }}" title="تخصيص الشاشات">
                                                <i class="fas fa-tasks"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger me-1" data-bs-toggle="modal" data-bs-target="#resetPasswordModal-{{ $user->id }}" title="إعادة ضبط كلمة المرور">
                                                <i class="fas fa-key"></i>
                                            </button>
                                        </div>

                                        @include('users.partials.reset_password_modal', ['user' => $user])
                                        @include('users.partials.permissions_modal', ['user' => $user])
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        لا يوجد مستخدمين.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($users->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
