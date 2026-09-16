<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="addUserModalLabel">إضافة مستخدم جديد</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">الاسم الرباعي</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">البريد الإلكتروني</label>
                        <input type="email" class="form-control" id="email" name="email" required dir="ltr">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">كلمة المرور</label>
                        <input type="password" class="form-control" id="password" name="password" required dir="ltr">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-bold">تأكيد كلمة المرور</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required dir="ltr">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label fw-bold">الصلاحية (الدور)</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="" disabled selected>اختر الصلاحية المبدئية...</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ وإضافة</button>
                </div>
            </form>
        </div>
    </div>
</div>
