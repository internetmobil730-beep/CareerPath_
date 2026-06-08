@extends('layouts.app')
@section('title','Becerilerin Testi')
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
        <h3 class="title quiz-title mb-4">Yeteneklerinizi/İlgi alanlarınızı seçin</h3>
    
        <form method="POST" action="{{ route('quiz.submit') }}" id="quizForm">@csrf
            <div class="row">
                @foreach($skills as $skill)
                <div class="col-md-4 mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="skills[]" value="{{ $skill->id }}"
                            id="sk{{ $skill->id }}">
                        <label class="form-check-label" for="sk{{ $skill->id }}">{{ $skill->name }}</label>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="card-footer p-2  text-end">
                <button type="submit" class="btn quiz-btn mt-4">
                    Sonuçları Görüntüle
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary mt-2 me-2">Geri Dön</a>
            </div>
        </form>


@section('scripts')
<script>
document.getElementById('quizForm').addEventListener('submit', function(e) {
    if (!document.querySelectorAll('input[name="skills[]"]:checked').length) {
        e.preventDefault();
        alert('En az bir beceri seçin');
    }
});
</script>
@endsection
@endsection