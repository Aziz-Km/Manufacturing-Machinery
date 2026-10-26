@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-3 mb-md-0 text-gold">
                    سجل الآلات والمعدات
                </h3>
                
                <div class="d-flex flex-wrap gap-2">
                    <form action="{{ route('machines.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="بحث برقم أو اسم الآلة..." value="{{ request('search') }}" style="min-width: 250px;">
                        <button type="submit" class="btn btn-outline-dark fw-bold"><i class="fas fa-search"></i> بحث</button>
                    </form>
                    <a href="{{ route('reports.machines') }}" target="_blank" class="btn btn-outline-dark fw-bold px-3" title="طباعة تقرير الآلات">
                        <i class="fas fa-print"></i> طباعة
                    </a>
                    <a href="{{ route('machines.create') }}" class="btn btn-primary fw-bold px-4">
                        إضافة آلة جديدة
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-center">
                            <thead class="bg-gold text-white">
                                <tr>
                                    <th class="py-3 px-4">رقم الآلة (Tag)</th>
                                    <th class="py-3 px-4">اسم الآلة</th>
                                    <th class="py-3 px-4">الموقع</th>
                                    <th class="py-3 px-4">المنطقة / المصنع</th>
                                    <th class="py-3 px-4">ساعات التشغيل</th>
                                    <th class="py-3 px-4">الحالة</th>
                                    <th class="py-3 px-4 text-center">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($machines as $machine)
                                <tr>
                                    <td class="py-3 px-4 fw-bold" style="text-align: right;" dir="ltr">{{ $machine->serial_number }}</td>
                                    <td class="py-3 px-4" style="text-align: right;">{{ $machine->name }}</td>
                                    <td class="py-3 px-4" dir="ltr"><span class="badge bg-info text-dark">{{ $machine->type ?? 'غير محدد' }}</span></td>
                                    <td class="py-3 px-4">
                                        <span class="badge bg-secondary">{{ $machine->factory->name ?? 'غير محدد' }}</span>
                                        @if($machine->production_line)
                                            <div class="mt-1"><small class="text-muted fw-bold">{{ $machine->production_line }}</small></div>
                                        @endif
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
                                        <form action="{{ route('machines.updateHours', $machine->id) }}" method="POST" class="d-flex justify-content-center align-items-center">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="hours_to_add" class="form-control form-control-sm me-2" placeholder="+ساعات" min="1" style="width: 80px;" required>
                                            <button type="submit" class="btn btn-sm btn-outline-success fw-bold" title="إضافة ساعات تشغيل"><i class="fas fa-plus"></i></button>
                                        </form>
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
