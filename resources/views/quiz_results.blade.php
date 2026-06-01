@extends('layouts.app')

@section('title', $major->name ?? 'Bölüm Detayları')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0 rounded-lg mb-4">
                <div class="card-header bg-primary text-white p-4">
                    <h2 class="mb-0 text-center fw-bold">{{ $major->name ?? 'Bölüm Adı' }}</h2>
                </div>
                <div class="card-body p-4">
                    <h4 class="text-primary border-bottom pb-2 mb-3">
                        <i class="fa-solid fa-file-lines me-2"></i>Bölüm Hakkında
                    </h4>
                    <p class="lead text-muted lh-base">
                        {{ $major->description ?? 'Bu bölüm hakkında açıklama bulunamadı.' }}
                    </p>
                </div>
            </div>

            <div class="card shadow border-0 rounded-lg">
                <div class="card-header bg-dark text-white p-3">
                    <h5 class="mb-0"><i class="fa-solid fa-graduation-cap me-2"></i>Bu Bölümü Sunan Üniversiteler</h5>
                </div>
                <div class="card-body p-4">
                    @if(isset($major->universities) && $major->universities->count() > 0)
                        <div class="row">
                            @foreach($major->universities as $university)
                                <div class="col-md-6 mb-3">
                                    <div class="p-3 border rounded d-flex justify-content-between align-items-center bg-light">
                                        <div>
                                            <h6 class="mb-1 fw-bold text-secondary">{{ $university->name }}</h6>
                                            <p class="text-muted small mb-0">
                                                <i class="fa-solid fa-location-dot me-1"></i>{{ $university->district ?? 'İstanbul' }}
                                            </p>
                                            {{-- عرض الرسوم المفصلة بناءً على جدول المحور Pivot --}}
                                            @if(isset($university->pivot->tuition_usd))
                                                <p class="text-muted mb-0 small mt-1">Ücret: ${{ $university->pivot->tuition_usd }}</p>
                                            @endif
                                        </div>
                                        {{-- تم تعديل اسم الروت هنا إلى university.details ليطابق ملف الـ web.php تماماً --}}
                                        <a href="{{ route('university.details', $university->id) }}" class="btn btn-sm btn-outline-primary">
                                            Üniversite Detayları
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fa-solid fa-circle-info fa-2x mb-2 text-warning"></i>
                            <p class="mb-0">Bu bölümü sunan aktif bir üniversite kaydı bulunamadı.</p>
                        </div>
                    @endif
                </div>
                <div class="card-footer p-3 text-end bg-transparent border-top-0">
                    {{-- تعديل زر الرجوع ليعود إلى صفحة الكويز بنجاح --}}
                    <a href="{{ route('quiz') }}" class="btn btn-secondary px-4 mt-2 me-2">Geri Dön</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection