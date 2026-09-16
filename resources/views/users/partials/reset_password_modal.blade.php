<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal-{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-start">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">إعادة ضبط كلمة المرور - {{ $user->name }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.resetPassword', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">كلمة المرور الجديدة</label>
                        <input type="password" class="form-control" name="password" required dir="ltr">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">تأكيد كلمة المرور الجديدة</label>
                        <input type="password" class="form-control" name="password_confirmation" required dir="ltr">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger fw-bold">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>
</div>
