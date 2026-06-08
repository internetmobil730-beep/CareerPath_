@section('title','Test_Sonuçları')
@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center align-items-center px-3">
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
    <h2 class="mb-4 title">Size En Uygun Bölümler (Sonuçlar)</h2>
    <div class="row">
        @forelse($matchingMajors->unique('name') as $major)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-lg" style="position: relative;">

                <div class="card-body text-center">
                    <h5 class="title">{{ $major->name }}</h5>
                    <p>
                        {{ Str::limit($major->description) }}
                    </p>
                    <div class="card-actions">
                        <a href="{{ route('major.details', $major->id) }}" class="detayuni btn">
                            Detayları Gör
                        </a>
                        @auth
                        @if(auth()->user()->favoriteMajors->contains($major->id))
                        <button class="btn-card-favorite active" data-id="{{ $major->id }}" data-type="major">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                        @else
                        <button class="btn-card-favorite" data-id="{{ $major->id }}" data-type="major">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                        @endif
                        @else
                        <button class="btn-card-favorite" data-id="{{ $major->id }}" data-type="major">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p>Üzgünüz, seçtiğiniz becerilere uygun bir bölüm bulunamadı.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection