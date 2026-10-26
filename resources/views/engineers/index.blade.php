@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0 text-gold">
                    <i class="fas fa-users-cog me-2"></i> سجل المهندسين
                </h3>
                <div class="d-flex gap-2">
                    <a href="{{ route('reports.engineers') }}" target="_blank" class="btn btn-outline-dark fw-bold px-3" title="طباعة تقرير مهام المهندسين">
                        <i class="fas fa-print me-1"></i> طباعة تقرير المهام
                    </a>
                    <a href="{{ route('engineers.create') }}" class="btn btn-primary fw-bold px-4">
                        <i class="fas fa-user-plus me-1"></i> إضافة مهندس جديد
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-center">
                            <thead class="bg-gold text-white">
                                <tr>
                                    <th class="py-3 px-4">الاسم</th>
                                    <th class="py-3 px-4">الرقم الوظيفي</th>
                                    <th class="py-3 px-4">البريد الإلكتروني</th>
                                    <th class="py-3 px-4">التخصص</th>
                                    <th class="py-3 px-4">مهام الصيانة الموكلة</th>
                                    <th class="py-3 px-4 text-center">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($engineers as $engineer)
                                <tr>
                                    <td class="py-3 px-4 fw-bold">
                                        <a href="{{ route('engineers.show', $engineer->id) }}" class="text-decoration-none text-dark">
                                            {{ $engineer->user->name ?? 'غير محدد' }}
                                        </a>
                                    </td>
                                    <td class="py-3 px-4 fw-bold text-primary">{{ $engineer->employee_id ?? '-' }}</td>
                                    <td class="py-3 px-4" dir="ltr">{{ $engineer->user->email ?? 'غير محدد' }}</td>
                                    <td class="py-3 px-4">
                                        <span class="badge bg-info text-dark">{{ $engineer->specialization ?? 'عام' }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="badge bg-secondary fs-6">{{ $engineer->tasks->count() }} مهام</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('reports.engineers', ['engineer_id' => $engineer->id]) }}" target="_blank" class="btn btn-outline-dark" title="طباعة مهام هذا المهندس">
                                                <i class="fas fa-print me-1"></i> طباعة المهام
                                            </a>
                                            <a href="{{ route('engineers.show', $engineer->id) }}" class="btn btn-outline-primary" title="عرض تفاصيل ومهام المهندس">
                                                <i class="fas fa-eye me-1"></i> عرض المهام
                                            </a>
                                            <a href="{{ route('engineers.edit', $engineer->id) }}" class="btn btn-outline-warning" title="تعديل البيانات">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        لا يوجد مهندسين مسجلين حالياً.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($engineers->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $engineers->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
