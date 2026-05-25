@section('title','Test_Sonuçları')
@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="mb-4 mt-5 title text-center">Size En Uygun Bölümler (Sonuçlar)</h2>
    <div class="row">
        {{-- قمنا بإزالة unique من هنا لضمان بقاء الترتيب الصحيح للأفضلية، حيث تم التعامل مع اللغات في الـ Controller أو يتم عرض التخصص كبطاقة ذكية --}}
        @forelse($matchingMajors as $major)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-lg position-relative">
                
                {{-- شارة إظهار درجة المطابقة بناء على المهارات التي اختارها --}}
                <div class="position-absolute top-0 end-0 m-2">
                    <span class="badge bg-success shadow-sm">
                        {{ $major->skills_count }} Eşleşen Beceri
                    </span>
                </div>

                <div class="card-body text-center d-flex flex-column justify-content-between mt-3">
                    <div>
                        <h5 class="title fw-bold text-dark">{{ $major->name }}</h5>
                        
                        {{-- إظهار لغة التعليم المتاحة لهذا السجل للتوضيح للمستخدم (مثلاً: TR أو EN) --}}
                        <span class="badge bg-light text-secondary border mb-3">
                            <i class="fas fa-graduation-cap"></i> {{ strtoupper($major->education_language) }}
                        </span>

                        <p class="text-muted small">
                            {{ Str::limit($major->description, 120) }}
                        </p>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('major_details_public', $major->id) }}" class="detayuni btn btn-warning w-100 fw-bold">
                            Detayları Gör
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center mt-5">
            <div class="alert alert-info">
                <p class="mb-0">Üzgünüz, seçtiğiniz becerilere uygun bir bölüm bulunamadı.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection