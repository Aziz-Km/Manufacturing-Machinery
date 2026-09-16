@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0 text-gold" dir="ltr">
                    <i class="fas fa-industry me-2"></i> {{ $factory->name }} Machines
                </h3>
                <a href="{{ route('factories.index') }}" class="btn btn-outline-secondary fw-bold px-4">
                    العودة للمصانع
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-center align-middle">
                            <thead class="bg-gold text-white">
                                <tr>
                                    <th class="py-3 px-4">رمز الآلة (Code)</th>
                                    <th class="py-3 px-4">اسم الآلة</th>
                                    <th class="py-3 px-4">ساعات التشغيل</th>
                                    <th class="py-3 px-4">الحالة</th>
                                    <th class="py-3 px-4">تاريخ آخر صيانة</th>
                                    <th class="py-3 px-4 text-center">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($machines as $machine)
                                <tr>
                                    <td class="py-3 px-4 fw-bold text-primary" dir="ltr">{{ $machine->code }}</td>
                                    <td class="py-3 px-4 fw-bold">{{ $machine->name }}</td>
                                    <td class="py-3 px-4" dir="ltr">
                                        <span class="badge bg-secondary">{{ number_format($machine->operating_hours) }} h</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        @if($machine->status == 'active')
                                            <span class="badge bg-success">تعمل</span>
                                        @elseif($machine->status == 'inactive')
                                            <span class="badge bg-warning text-dark">متوقفة</span>
                                        @else
                                            <span class="badge bg-danger">في الصيانة</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4" dir="ltr">
                                        {{ $machine->last_maintenance_date ?? 'غير محدد' }}
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <a href="{{ route('machines.show', $machine->id) }}" class="btn btn-sm btn-outline-primary" title="التفاصيل">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        لا توجد آلات مسجلة في هذا المصنع.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($machines->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $machines->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
