@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0 text-gold">
                    <i class="fas fa-list-check me-2"></i> إدارة كتالوج المهام القياسية
                </h3>
                <div>
                    <a href="{{ route('catalogs.template') }}" class="btn btn-outline-success fw-bold me-2">
                        <i class="fas fa-file-excel"></i> تحميل قالب Excel/CSV
                    </a>
                    <button type="button" class="btn btn-info fw-bold text-white me-2" data-bs-toggle="modal" data-bs-target="#importCatalogModal">
                        <i class="fas fa-upload"></i> استيراد (رفع المهام)
                    </button>
                    <button type="button" class="btn btn-primary fw-bold px-4" data-bs-toggle="modal" data-bs-target="#addCatalogModal">
                        <i class="fas fa-plus"></i> إضافة مفردة
                    </button>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success fw-bold">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger fw-bold">
                    يرجى التأكد من اختيار ملف صالح.
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-gold text-white">
                                <tr>
                                    <th class="py-3 px-4">التسلسل</th>
                                    <th class="py-3 px-4">الرمز (Code)</th>
                                    <th class="py-3 px-4">الوصف (Description)</th>
                                    <th class="py-3 px-4">التخصص</th>
                                    <th class="py-3 px-4 text-center">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($catalogs as $catalog)
                                <tr>
                                    <td class="py-3 px-4 fw-bold">{{ $catalog->sequence }}</td>
                                    <td class="py-3 px-4 fw-bold text-primary" dir="ltr">{{ $catalog->code }}</td>
                                    <td class="py-3 px-4" dir="ltr">{{ $catalog->description }}</td>
                                    <td class="py-3 px-4">
                                        @if($catalog->category == 'mechanical')
                                            <span class="badge bg-secondary">ميكانيكا</span>
                                        @elseif($catalog->category == 'electrical')
                                            <span class="badge bg-warning text-dark">كهرباء</span>
                                        @else
                                            <span class="badge bg-info">عام</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <form action="{{ route('catalogs.destroy', $catalog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة من الكتالوج؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-box-open fs-1 d-block mb-3"></i>
                                        الكتالوج فارغ حالياً.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($catalogs->hasPages())
                    <div class="card-footer bg-white py-3">
                        {{ $catalogs->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importCatalogModal" tabindex="-1" aria-labelledby="importCatalogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="importCatalogModalLabel">استيراد المهام (Excel/CSV)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('catalogs.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p class="text-muted text-sm mb-4">
                        <i class="fas fa-info-circle text-info"></i> يرجى تحميل قالب الملف وتعبئته بالمهام، ثم حفظه كملف <strong>CSV (Comma delimited)</strong> ورفعه هنا.
                    </p>
                    <div class="mb-3">
                        <label for="csv_file" class="form-label fw-bold">اختر ملف الـ CSV</label>
                        <input class="form-control" type="file" id="csv_file" name="csv_file" accept=".csv, .txt" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-info text-white fw-bold">رفع واستيراد</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addCatalogModal" tabindex="-1" aria-labelledby="addCatalogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-gold text-white">
                <h5 class="modal-title" id="addCatalogModalLabel">إضافة مهمة جديدة للكتالوج</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('catalogs.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="sequence" class="form-label fw-bold">رقم التسلسل</label>
                        <input type="number" class="form-control" id="sequence" name="sequence" required>
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label fw-bold">الرمز (Code)</label>
                        <input type="text" class="form-control" id="code" name="code" dir="ltr" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">الوصف (Description)</label>
                        <input type="text" class="form-control" id="description" name="description" dir="ltr" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label fw-bold">التخصص</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="mechanical" selected>ميكانيكا (Mechanical)</option>
                            <option value="electrical">كهرباء (Electrical)</option>
                            <option value="general">عام / أخرى</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ المهمة</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
