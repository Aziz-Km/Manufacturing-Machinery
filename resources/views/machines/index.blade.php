@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0 text-gold">
                    سجل الآلات والمعدات
                </h3>
                <button class="btn btn-primary fw-bold px-4">
                    إضافة آلة جديدة
                </button>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-center">
                            <thead class="bg-gold text-white">
                                <tr>
                                    <th class="py-3 px-4">رقم الآلة (Tag)</th>
                                    <th class="py-3 px-4">اسم الآلة</th>
                                    <th class="py-3 px-4">المنطقة / المصنع</th>
                                    <th class="py-3 px-4">ساعات التشغيل</th>
                                    <th class="py-3 px-4">الحالة</th>
                                    <th class="py-3 px-4 text-center">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($machines as $machine)
                                <tr>
                                    <td class="py-3 px-4 fw-bold" style="text-align: right;">{{ $machine->serial_number }}</td>
                                    <td class="py-3 px-4" style="text-align: right;">{{ $machine->name }}</td>
                                    <td class="py-3 px-4">
                                        <span class="badge bg-secondary">{{ $machine->factory->name ?? 'غير محدد' }}</span>
                                    </td>
                                    <td class="py-3 px-4" dir="ltr">
                                        <span class="fw-bold {{ $machine->total_operating_hours > 20000 ? 'text-danger' : 'text-success' }}">
                                            {{ number_format($machine->total_operating_hours) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        @if($machine->status == 'active')
                                            <span class="badge bg-success">نشط</span>
                                        @elseif($machine->status == 'maintenance')
                                            <span class="badge bg-warning text-dark">في الصيانة</span>
                                        @else
                                            <span class="badge bg-danger">متوقف</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <button class="btn btn-sm btn-outline-primary">تفاصيل</button>
                                        <button class="btn btn-sm btn-outline-warning">صيانة</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        لا توجد آلات مسجلة بعد.
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
