@extends('layouts.app', ['hide_sidebar' => true])
@section('title','ÜNİVERSİTE_DETAYLARI')

@section('content')
<div class="container uni2">
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
    <div class="card details-card shadow-lg  d-flex flex-column ">
        <div class="card-header p-5">
            <h2 class="title">{{ $university->name }}</h2>
            @auth
                @if(auth()->user()->favoriteUniversities->contains($university->id))
                    <button class="btn-card-favorite cart-details-fav active" data-id="{{ $university->id }}" data-type="university">
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
            <h3 >Hakkında:</h3>
            <p>{{ $university->description }}</p>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Tür : </strong> {{ $university->type == 'devlet' ? 'Devlet ' : 'Vakıf' }}</li>
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
        <div class="card-footer p-2  text-end">
            <a href="{{ route('major_details_public', $major->id) }}" class="btn btn-secondary mt-2 me-2">Geri Dön</a>
        </div>
    </div>
</div>
@endsection