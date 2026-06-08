@section('title','BÖLÜM_DETAYLARI')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center mt-5 px-3">
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
    <div class="card details-card shadow-lg  d-flex flex-column mb-4">
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
                <div class="card-footer p-2  text-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-2 me-2">Geri Dön</a>
                </div>
            </div>

            <div class="collapse mt-4" id="uniCollapse">
                <div class="row">
                    @forelse($major->universities as $university)
                    <div class="details-card col-md-4 mb-3">
                        <div class="card h-100 p-3 border-warning shadow-sm d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="fw-bold" style="color: #15737a;">{{ $university->name }}</h5>
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
</div>
@endsection