<div class="modal fade" id="permissionsModal-{{ $user->id }}" tabindex="-1" aria-labelledby="permissionsModalLabel-{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="permissionsModalLabel-{{ $user->id }}">
                    <i class="fas fa-user-shield me-2"></i> تخصيص صلاحيات الشاشات لـ: {{ $user->name }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.updatePermissions', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <p class="text-muted mb-4 text-sm">حدد الشاشات التي يحق لهذا المستخدم الوصول إليها وإدارتها. هذه الصلاحيات تتغلب على الرتبة الافتراضية.</p>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-check form-switch fs-5 mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="perm_factories_{{ $user->id }}" name="permissions[]" value="manage_factories" {{ $user->hasPermissionTo('manage_factories') ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="perm_factories_{{ $user->id }}"><i class="fas fa-industry text-primary"></i> المصانع</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch fs-5 mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="perm_machines_{{ $user->id }}" name="permissions[]" value="manage_machines" {{ $user->hasPermissionTo('manage_machines') ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="perm_machines_{{ $user->id }}"><i class="fas fa-cogs text-secondary"></i> الآلات</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch fs-5 mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="perm_engineers_{{ $user->id }}" name="permissions[]" value="manage_engineers" {{ $user->hasPermissionTo('manage_engineers') ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="perm_engineers_{{ $user->id }}"><i class="fas fa-users-cog text-success"></i> المهندسين</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch fs-5 mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="perm_catalogs_{{ $user->id }}" name="permissions[]" value="manage_catalogs" {{ $user->hasPermissionTo('manage_catalogs') ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="perm_catalogs_{{ $user->id }}"><i class="fas fa-list-check text-info"></i> كتالوج المهام</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch fs-5 mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="perm_tasks_{{ $user->id }}" name="permissions[]" value="manage_tasks" {{ $user->hasPermissionTo('manage_tasks') ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="perm_tasks_{{ $user->id }}"><i class="fas fa-tools text-warning"></i> أوامر الصيانة</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch fs-5 mb-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="perm_users_{{ $user->id }}" name="permissions[]" value="manage_users" {{ $user->hasPermissionTo('manage_users') ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="perm_users_{{ $user->id }}"><i class="fas fa-shield-alt text-danger"></i> الصلاحيات والمستخدمين</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary fw-bold">حفظ الصلاحيات</button>
                </div>
            </form>
        </div>
    </div>
</div>
