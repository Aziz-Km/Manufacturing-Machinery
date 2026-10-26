@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-3 mb-md-0 text-gold" dir="ltr">
                    <i class="fas fa-industry me-2"></i> {{ $factory->name }} Machines
                </h3>
                
                <div class="d-flex flex-wrap gap-2">
                    <form action="{{ route('factories.show', $factory->id) }}" method="GET" class="d-flex">
                        <input type="hidden" name="line" value="{{ request('line') }}">
                        <input type="text" name="search" class="form-control me-2" placeholder="بحث برقم أو اسم الآلة..." value="{{ request('search') }}" style="min-width: 250px;">
                        <button type="submit" class="btn btn-outline-dark fw-bold"><i class="fas fa-search"></i> بحث</button>
                    </form>
                    <a href="{{ route('factories.index') }}" class="btn btn-outline-secondary fw-bold px-4">
                        العودة للمصانع
                    </a>
                </div>
            </div>

            @if($factory->name == 'GPP')
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link fw-bold {{ !request('line') ? 'active bg-gold text-white' : 'text-dark' }}" href="{{ route('factories.show', ['factory' => $factory->id, 'search' => request('search')]) }}">
                        جميع الآلات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold {{ request('line') == 'خط البينتونايت' ? 'active bg-gold text-white' : 'text-dark' }}" href="{{ route('factories.show', ['factory' => $factory->id, 'line' => 'خط البينتونايت', 'search' => request('search')]) }}">
                        خط البينتونايت
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold {{ request('line') == 'خط البرايت' ? 'active bg-gold text-white' : 'text-dark' }}" href="{{ route('factories.show', ['factory' => $factory->id, 'line' => 'خط البرايت', 'search' => request('search')]) }}">
                        خط البرايت
                    </a>
                </li>
            </ul>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 text-center align-middle">
                            <thead class="bg-gold text-white">
                                <tr>
                                    <th class="py-3 px-4">رقم الآلة (Tag)</th>
                                    <th class="py-3 px-4">اسم الآلة</th>
                                    <th class="py-3 px-4">الموقع</th>
                                    <th class="py-3 px-4">التصنيف</th>
                                    <th class="py-3 px-4">ساعات التشغيل</th>
                                    <th class="py-3 px-4">الحالة</th>
                                    <th class="py-3 px-4 text-center">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($machines as $machine)
                                <tr>
                                    <td class="py-3 px-4 fw-bold text-primary" dir="ltr">{{ $machine->serial_number }}</td>
                                    <td class="py-3 px-4 fw-bold">{{ $machine->name }}</td>
                                    <td class="py-3 px-4" dir="ltr"><span class="badge bg-info text-dark">{{ $machine->type ?? 'غير محدد' }}</span></td>
                                    <td class="py-3 px-4 fw-bold text-muted">{{ $machine->production_line ?? 'بدون تصنيف' }}</td>
                                    <td class="py-3 px-4" dir="ltr">
                                        <span class="badge bg-secondary">{{ number_format($machine->total_operating_hours) }} h</span>
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
                                    <td class="py-3 px-4 text-center">
                                        <a href="{{ route('machines.index') }}" class="btn btn-sm btn-outline-primary" title="التفاصيل">
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
