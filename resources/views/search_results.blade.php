@extends('layouts.app') 
@section('title','Arama Sonuçları')
@section('content')
<div class="container mt-5">
    
    <h2 class="mb-4 text-center text-secondary">"{{ $query }}" İçin Sonuçlar</h2>
    <hr class="mb-5">

    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-9">
            
            @if($universities->isEmpty() && $majors->isEmpty() && $skills->isEmpty())
                <div class="alert alert-info text-center py-4 rounded-3 shadow-sm">
                    Aradığınız kriterlere uygun bir sonuç bulunamadı.
                </div>
            @else
                <div class="search-results-wrapper">

                    {{-- 1. قسم الجامعات --}}
                    @foreach($universities as $uni)
                        <div class="card mb-5 shadow-sm border-1 rounded-3" style="border-color: #fcece8;">
                            <div class="card-body p-5">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    {{-- تلوين العناوين باللون الزيتي الجذاب المماثل للصورة الثانية --}}
                                    <h2 class="title font-weight-bold" style="color: #15737a;">{{ $uni->name }}</h2>
                                    <span class="badge px-3 py-2 rounded-pill" style="background-color: #E49BA6; color: #fff;">Üniversite</span>
                                </div>
                                <hr class="my-4">
                                
                                <div class="mb-4">
                                    <h5 class="font-weight-bold mb-2">Hakkında:</h5>
                                    <p class="card-text text-muted" style="font-size: 1.05rem; line-height: 1.7;">
                                        {{ Str::limit($uni->description, 250) }}
                                    </p>
                                </div>

                                <div class="row bg-light p-3 rounded mb-4 mx-0" style="font-size: 0.95rem;">
                                    <div class="col-sm-6 mb-2 mb-sm-0">
                                        <strong">İlçe / Konum:</strong> <span class="text-secondary">{{ $uni->district }} ({{ $uni->side }})</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong">Tür:</strong> <span class="text-secondary">{{ ucfirst($uni->type) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- 2. قسم التخصصات --}}
                    @foreach($majors as $major)
                        <div class="card mb-5 shadow-sm border-1 rounded-3" style="border-color: #fcece8;">
                            <div class="card-body p-5">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h2 class="title font-weight-bold" style="color: #15737a;">{{ $major->name }}</h2>
                                    <span class="badge px-3 py-2 rounded-pill" style="background-color: #E49BA6; color: #fff;">Bölüm</span>
                                </div>
                                <hr class="my-4">
                    
                                <div class="mb-4 p-3 border-start border-primary border-4 bg-light rounded">
                                    <p class="card-text text-secondary mb-0" style="font-size: 1.05rem; line-height: 1.6;">
                                        {{ Str::limit($major->description, 250) }}
                                    </p>
                                </div>
                                
                                <div class="mt-5">
                                    <button class="btn btn-lg px-5 py-3 shadow text-white" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#uniCollapse{{ $major->id }}" style="background-color: #ffcc00; font-weight: 500;">
                                        Bu Bölümü Sunan Üniversiteleri Gör
                                    </button>
                                </div>
                    
                                <div class="collapse mt-4" id="uniCollapse{{ $major->id }}">
                                    <div class="row">
                                        @forelse($major->universities as $university)
                                        <div class="details-card col-md-4 mb-3">
                                            <div class="card h-100 p-3 border-warning shadow-sm d-flex flex-column justify-content-between" style="border-radius: 12px; border-color: #fcece8 !important;">
                                                <div>
                                                    <h5 class="fw-bold" style="color: #15737a;">{{ $university->name }}</h5>
                                                    <p class="text-muted mb-2 small">Anlaşmalı Ücret: ${{ $university->pivot->tuition_usd ?? '0' }}</p>
                                                </div>
                                                <div class="mt-2 text-end">
                                                    {{-- تنسيق زر الانتقال مثل لون الصورة الثانية تماماً --}}
                                                    <a href="{{ route('university.details', $university->id) }}" class="detayuni btn">
                                                        Detayları Gör
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <p class="text-center text-muted">Bu bölüm için kayıtlı üniversite bulunamadى.</p>
                                        @endforelse
                                    </div>
                                </div>
                    
                            </div>
                        </div>
                    @endforeach

                    {{-- 3. قسم المهارات (مع حل مشكلة التكرار الموضحة في صورة image_21c16c.png) --}}
                    @foreach($skills as $skill)
                        <div class="card mb-4 shadow-sm border-1 rounded-3" style="border-color: #fcece8;">
                            <div class="card-body p-5">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h2 class="title font-weight-bold" style="color: #15737a;">{{ $skill->name }}</h2>
                                    <span class="badge px-3 py-2 rounded-pill" style="background-color: #E49BA6; color: #fff;">Yetenek</span>
                                </div>
                               
                                <div class="mt-5">
                                    <button class="btn btn-lg px-5 py-3 shadow text-white" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#skillCollapse{{ $skill->id }}" style="background-color: #ffcc00; font-weight: 500;">
                                        Bu Beceriye Uygun Bölümleri Gör
                                    </button>
                                </div>
                    
                                <div class="collapse mt-4" id="skillCollapse{{ $skill->id }}">
                                    <div class="row">
                                        {{--  هنا السر السحري: استخدام unique('name') لمنع تكرار التخصصات داخل نفس المهارة --}}
                                        @forelse($skill->majors->unique('name') as $major)
                                        <div class="details-card col-md-4 mb-3">
                                            <div class="card h-100 p-4 shadow-sm d-flex flex-column justify-content-between" 
                                                 style="border-radius: 15px; border: 1px solid #fcece8; background-color: #fff;">
                                                <div>
                                                    {{-- ألوان النصوص المتناسقة كما في صورة image_21c1a9.png --}}
                                                    <h4 class="fw-bold text-center mb-3" style="color: #15737a; font-size: 1.35rem;">{{ $major->name }}</h4>
                                                    <p class="text-muted small mb-4 text-center" style="line-height: 1.5;">
                                                        {{ Str::limit($major->description, 90) }}
                                                    </p>
                                                </div>
                    
                                                <div class="mt-2 text-center">
                                                    {{-- تنسيق الزر الوردي الأنيق Detayları Gör --}}
                                                    <a href="{{ route('major.details', $major->id) }}"
                                                       class="detayuni btn">
                                                        Detayları Gör
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="col-12 text-center">
                                            <p class="text-muted">Bu beceri ile eşleşen bir bölüm bulunamadı.</p>
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                    
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif

        </div>
    </div>
</div>
@endsection