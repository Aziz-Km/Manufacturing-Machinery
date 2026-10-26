<div class="modal fade" id="detailsModal-{{ $task->id }}" tabindex="-1" aria-labelledby="detailsModalLabel-{{ $task->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gold text-white">
                <div class="d-flex align-items-center">
                    <h5 class="modal-title fw-bold mb-0" id="detailsModalLabel-{{ $task->id }}">
                        <i class="fas fa-file-invoice me-2"></i> أمر صيانة رقم #{{ $task->id }}
                    </h5>
                    <span class="ms-3">
                        @if($task->status == 'pending')
                            <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> قيد الانتظار</span>
                        @elseif($task->status == 'in_progress')
                            <span class="badge bg-warning text-dark"><i class="fas fa-tools me-1"></i> جاري العمل</span>
                        @elseif($task->status == 'completed')
                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> مكتمل</span>
                        @endif
                    </span>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4 text-start">
                <div class="row g-3">
                    
                    <!-- Machine Details -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light h-100">
                            <h6 class="fw-bold text-gold border-bottom pb-2 mb-3">
                                <i class="fas fa-cogs me-1"></i> بيانات الآلة / المعدة
                            </h6>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <th class="text-muted" style="width: 40%;">رقم الآلة (Tag):</th>
                                    <td class="fw-bold" dir="ltr">{{ $task->machine->serial_number ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">اسم الآلة:</th>
                                    <td class="fw-bold">{{ $task->machine->name ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">المصنع:</th>
                                    <td>{{ $task->machine->factory->name ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">خط الإنتاج:</th>
                                    <td>{{ $task->machine->production_line ?? 'غير محدد' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">ساعات التشغيل:</th>
                                    <td dir="ltr">{{ number_format($task->machine->total_operating_hours ?? 0) }} ساعة</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Task & Engineer Details -->
                    <div class="col-md-6">
                        <div class="p-3 border rounded bg-light h-100">
                            <h6 class="fw-bold text-gold border-bottom pb-2 mb-3">
                                <i class="fas fa-clipboard-list me-1"></i> تفاصيل أمر الصيانة
                            </h6>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <th class="text-muted" style="width: 40%;">التخصص:</th>
                                    <td>
                                        @if($task->category == 'mechanical')
                                            <span class="badge bg-primary"><i class="fas fa-cogs"></i> ميكانيكا</span>
                                        @elseif($task->category == 'electrical')
                                            <span class="badge bg-warning text-dark"><i class="fas fa-bolt"></i> كهرباء</span>
                                        @else
                                            <span class="badge bg-secondary"><i class="fas fa-tools"></i> عام</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">نوع الصيانة:</th>
                                    <td>
                                        @if($task->type == 'preventive')
                                            <span class="badge bg-info text-dark">وقائية (دورية)</span>
                                        @else
                                            <span class="badge bg-danger">تصحيحية (إصلاح عطل)</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">المهندس المكلف:</th>
                                    <td class="fw-bold text-primary">
                                        <i class="fas fa-user-circle me-1"></i>
                                        {{ $task->engineer->user->name ?? 'لم يُحدد بعد' }}
                                        @if($task->engineer)
                                            <small class="text-muted d-block">({{ $task->engineer->specialization }})</small>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">تاريخ الجدولة:</th>
                                    <td dir="ltr" class="fw-bold">
                                        {{ $task->scheduled_date ? $task->scheduled_date->format('Y-m-d') : 'غير محدد' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">تاريخ الإنجاز:</th>
                                    <td dir="ltr" class="fw-bold text-success">
                                        {{ $task->completion_date ? $task->completion_date->format('Y-m-d') : 'قيد العمل' }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Catalog Reference if exists -->
                    @if($task->catalog)
                    <div class="col-12">
                        <div class="p-3 border rounded bg-white">
                            <h6 class="fw-bold text-secondary mb-2">
                                <i class="fas fa-list-check me-1"></i> المهمة القياسية المقترنة (الكتالوج)
                            </h6>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-dark me-2 fs-6" dir="ltr">{{ $task->catalog->code }}</span>
                                <span class="fw-bold" dir="ltr">{{ $task->catalog->description }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Notes -->
                    <div class="col-12">
                        <div class="p-3 border rounded bg-white">
                            <h6 class="fw-bold text-muted mb-2">
                                <i class="fas fa-sticky-note me-1"></i> الملاحظات وتقرير العمل
                            </h6>
                            <p class="mb-0 text-dark" style="white-space: pre-line;">
                                {{ $task->notes ?: 'لا توجد ملاحظات مسجلة لهذا الأمر.' }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer bg-light d-flex justify-content-between">
                <div>
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-outline-dark fw-bold">
                        <i class="fas fa-external-link-alt me-1"></i> فتح الصفحة الكاملة والطباعة
                    </a>
                </div>
                <div>
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">إغلاق</button>
                    <button type="button" class="btn btn-success fw-bold" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#statusModal-{{ $task->id }}">
                        <i class="fas fa-sync-alt me-1"></i> تحديث الحالة الآن
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
