<div class="modal fade" id="statusModal-{{ $task->id }}" tabindex="-1" aria-labelledby="statusModalLabel-{{ $task->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gold text-white">
                <h5 class="modal-title fw-bold" id="statusModalLabel-{{ $task->id }}">
                    <i class="fas fa-sync-alt me-2"></i> تحديث حالة أمر الصيانة #{{ $task->id }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body p-4 text-start">
                    <!-- Machine & Current Status Info Banner -->
                    <div class="p-3 mb-3 bg-light rounded border d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted d-block small">الآلة المستهدفة:</span>
                            <span class="fw-bold text-dark" dir="ltr">{{ $task->machine->serial_number ?? 'غير محدد' }}</span>
                            <span class="text-muted small">({{ $task->machine->name ?? '' }})</span>
                        </div>
                        <div class="text-end">
                            <span class="text-muted d-block small">الحالة الحالية:</span>
                            @if($task->status == 'pending')
                                <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> قيد الانتظار</span>
                            @elseif($task->status == 'in_progress')
                                <span class="badge bg-warning text-dark"><i class="fas fa-tools me-1"></i> جاري العمل</span>
                            @elseif($task->status == 'completed')
                                <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> مكتمل</span>
                            @endif
                        </div>
                    </div>

                    <!-- New Status Selection -->
                    <div class="mb-3">
                        <label for="status_{{ $task->id }}" class="form-label fw-bold">
                            <i class="fas fa-tasks text-primary me-1"></i> اختر الحالة الجديدة:
                        </label>
                        <select name="status" id="status_{{ $task->id }}" class="form-select form-select-lg fw-bold" required onchange="toggleCompletionDateField(this, '{{ $task->id }}')">
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>
                                ⏳ قيد الانتظار (لم يبدأ بعد)
                            </option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>
                                ⚙️ جاري العمل (تحت التنفيذ)
                            </option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>
                                ✅ مكتمل (تم إنجاز الصيانة بنجاح)
                            </option>
                        </select>
                    </div>

                    <!-- Engineer Assignment / Reassignment -->
                    <div class="mb-3">
                        <label for="engineer_id_{{ $task->id }}" class="form-label fw-bold">
                            <i class="fas fa-user-cog text-secondary me-1"></i> المهندس المكلف:
                        </label>
                        <select name="engineer_id" id="engineer_id_{{ $task->id }}" class="form-select">
                            <option value="">-- لم يحدد بعد --</option>
                            @foreach($engineers as $eng)
                                <option value="{{ $eng->id }}" {{ $task->engineer_id == $eng->id ? 'selected' : '' }}>
                                    {{ $eng->user->name ?? 'مهندس' }} ({{ $eng->specialization }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Completion Date Field (Dynamic / Visible when completed) -->
                    <div class="mb-3" id="completion_date_group_{{ $task->id }}" style="{{ $task->status == 'completed' ? '' : 'display: none;' }}">
                        <label for="completion_date_{{ $task->id }}" class="form-label fw-bold text-success">
                            <i class="fas fa-calendar-check me-1"></i> تاريخ إنجاز المهمة:
                        </label>
                        <input type="date" name="completion_date" id="completion_date_{{ $task->id }}" 
                               class="form-control" 
                               value="{{ $task->completion_date ? $task->completion_date->format('Y-m-d') : now()->format('Y-m-d') }}">
                        <small class="text-muted">عند تحديد "مكتمل"، سيتم اعتماد هذا التاريخ كتاريخ إغلاق الأمر.</small>
                    </div>

                    <!-- Notes / Work Report -->
                    <div class="mb-3">
                        <label for="notes_{{ $task->id }}" class="form-label fw-bold">
                            <i class="fas fa-clipboard-check text-info me-1"></i> تقرير العمل والملاحظات:
                        </label>
                        <textarea name="notes" id="notes_{{ $task->id }}" rows="3" class="form-control" placeholder="أضف أي تفاصيل حول ما تم تنفيذه، القطع المستبدلة، أو التوصيات...">{{ $task->notes }}</textarea>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4">
                        <i class="fas fa-check me-1"></i> حفظ وتحديث الحالة
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
