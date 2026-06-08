@extends('layouts.app')
@section('title','Arama Sonuçları')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center mt-5 mb-4 px-3">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="d-flex align-items-center justify-content-center p-2 rounded custom-search-container">

                <form action="{{ route('global.search') }}" method="GET" class="flex-grow-1 me-2 mb-0">
                    <div class="input-group search-input-group">
                        <input class="form-control search-field" type="search" name="query" placeholder="Quiz, Bölüm..."
                            value="{{ request('query') }}" required>

                        <button type="submit" class="btn search-submit-btn search">
                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        </button>
                    </div>
                </form>

                <div class="header_icons flex-shrink-0">
                    <div class="icon favorite-trigger">
                        <a href="#" class="d-block text-decoration-none">
                            <i class="fa-regular fa-heart custom-heart-icon"></i>
                            <span class="count count_favourite">0</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <div class="card details-card shadow-lg  d-flex flex-column ">
                        <div class="card-header p-5">
                            <h2 class="title">{{ $university->name }}</h2>
                            @auth
                            @if(auth()->user()->favoriteUniversities->contains($university->id))
                            <button class="btn-card-favorite cart-details-fav active" data-id="{{ $university->id }}"
                                data-type="university">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                            @else
                            <button class="btn-card-favorite cart-details-fav" data-id="{{ $university->id }}" data-type="university">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                            @endif
                            @else
                            <button class="btn-card-favorite cart-details-fav" data-id="{{ $university->id }}" data-type="university">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                            @endauth
                        </div>
                        <div class="card-body p-3">
                            <h3>Hakkında:</h3>
                            <p>{{ $university->description }}</p>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Tür : </strong>
                                            {{ $university->type == 'devlet' ? 'Devlet ' : 'Vakıf' }}</li>
                                        <li class="list-group-item"><strong>İlçe : </strong> {{ $university->district }}</li>
                                        <li class="list-group-item"><strong>Yaka : </strong> {{ $university->side }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Eğitim Dilleri : <br></strong>
                                            @foreach($university->education_languages as $lang)
                                            <span class="badge fs-6 me-2 mt-3">{{ strtoupper($lang) }}</span>
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- 2. قسم التخصصات --}}
                @foreach($majors as $major)
                    <div class="card details-card shadow-lg  d-flex flex-column mb-5">
                         <div class="card-body p-5">
                             <h1 class="title  mb-4">{{ $major->name }}</h1>
                 
                             @auth
                             @if(auth()->user()->favoriteMajors->contains($major->id))
                             <button class="btn-card-favorite cart-details-fav active" data-id="{{ $major->id }}" data-type="major">
                                 <i class="fa-solid fa-heart"></i>
                             </button>
                             @else
                             <button class="btn-card-favorite cart-details-fav" data-id="{{ $major->id }}" data-type="major">
                                 <i class="fa-regular fa-heart"></i>
                             </button>
                             @endif
                             @else
                             <button class="btn-card-favorite cart-details-fav" data-id="{{ $major->id }}" data-type="major">
                                 <i class="fa-regular fa-heart"></i>
                             </button>
                             @endauth
                 
                             <div class="d-flex gap-3 mb-4">
                                 <div class="p-2 border rounded bg-light">
                                     <strong class="thead">Eğitim Dili:</strong>
                                     <span class="badge fs-6 me-2">{{ $availableLanguages }}</span>
                                 </div>
                 
                                 <div class="p-2 border rounded bg-light">
                                     <strong class="thead">Derece:</strong>
                                     <span class="badge fs-6 me-2">{{ $major->degree_type }}</span>
                                 </div>
                             </div>
                 
                             <hr>
                 
                             <div class="mt-4">
                                 <div class="p-4 border-start border-4 border-primary bg-white shadow-sm"
                                     style="font-size: 1.2rem; line-height: 1.8;">
                                     {{-- عرض الشرح كما هو مخزن في الداتابيز --}}
                                     {!! nl2br(e($major->description)) !!}
                                 </div>
                             </div>
                 
                             {{-- الزر الذي يظهر الجامعات عند الضغط عليه --}}
                             <div class="mt-5">
                                 <button class="btn btn-lg px-5 py-3 shadow" type="button" data-bs-toggle="collapse"
                                     data-bs-target="#uniCollapse">
                                     Bu Bölümü Sunan Üniversiteleri Gör
                                 </button>
                             </div>
                 
                             <div class="collapse mt-4" id="uniCollapse">
                                 <div class="row">
                                     @forelse($major->universities as $university)
                                     <div class="details-card col-md-4 mb-3">
                                         <div class="card h-100 p-3 border-warning shadow-sm d-flex flex-column justify-content-between">
                                             <div>
                                                 <h5 class="fw-bold">{{ $university->name }}</h5>
                                                 <p class="text-muted mb-2 small">Ücret: ${{ $university->pivot->tuition_usd }}</p>
                                             </div>
                 
                                             <div class="mt-2 text-end">
                 
                                                 <a href="{{ route('university_details', $university->id) }}"
                                                     class="detayuni btn btn-sm btn-outline-warning">
                                                     Üniversite Detayları
                                                 </a>
                                                 @auth
                                                 @if(auth()->user()->favoriteUniversities->contains($university->id))
                                                 <button class="btn-card-favorite uni-cart active" data-id="{{ $university->id }}"
                                                     data-type="university">
                                                     <i class="fa-solid fa-heart"></i>
                                                 </button>
                                                 @else
                                                 <button class="btn-card-favorite uni-cart" data-id="{{ $university->id }}"
                                                     data-type="university">
                                                     <i class="fa-regular fa-heart"></i>
                                                 </button>
                                                 @endif
                                                 @else
                                                 <button class="btn-card-favorite uni-cart" data-id="{{ $university->id }}"
                                                     data-type="university">
                                                     <i class="fa-regular fa-heart"></i>
                                                 </button>
                                                 @endauth
                                             </div>
                                         </div>
                                     </div>
                                     @empty
                                     <p class="text-center text-muted">Kayıtlı üniversite bulunamadı.</p>
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
                            <span class="badge px-3 py-2 rounded-pill"
                                style="background-color: #E49BA6; color: #fff;">Yetenek</span>
                        </div>

                        <div class="mt-5">
                            <button class="btn btn-lg px-5 py-3 shadow" type="button"data-bs-toggle="collapse" 
                                data-bs-target="#skillCollapse{{ $skill->id }}">
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
                                            <h4 class="fw-bold text-center mb-3"
                                                style="color: #15737a; font-size: 1.35rem;">{{ $major->name }}</h4>
                                            <p class="text-muted small mb-4 text-center" style="line-height: 1.5;">
                                                {{ Str::limit($major->description, 90) }}
                                            </p>
                                        </div>

                                        <div class="mt-2 text-center">
                                            {{-- تنسيق الزر الوردي الأنيق Detayları Gör --}}
                                            <a href="{{ route('major.details', $major->id) }}"
                                                class="btn btn-md text-white px-4 py-2"
                                                style="background-color: #D38B97; border-radius: 8px; font-size: 0.95rem; font-weight: 500;">
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