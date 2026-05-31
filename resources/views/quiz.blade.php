@extends('layouts.app')
@section('title','Becerilerin Testi')
@section('content')
<div class="container">
    <div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="d-flex align-items-center justify-content-center bg-light p-2 rounded shadow-sm">
                
                <form action="{{ route('global.search') }}" method="GET" class="flex-grow-1 me-3">
                    <div class="input-group">
                        <input class="form-control border-0 bg-transparent" type="search" name="query" placeholder="ابحث عن تخصص، جامعة، أو اختبار..." value="{{ request('query') }}" required>
                        <button class="btn btn-primary rounded-pill px-4" type="submit">
                            <i class="fa fa-search d-md-none"></i> <span class="d-none d-md-inline">بحث</span> </button>
                    </div>
                </form>

                <div class="header_icons flex-shrink-0">
                    <div class="icon favorite-trigger">
                        <a href="#" class="position-relative d-inline-block text-decoration-none text-dark p-2">
                            <i class="fa-regular fa-heart fs-4 text-danger"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger count count_favourite" style="font-size: 0.65rem;">
                                0
                            </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    <h3 class="title quiz-title mb-4">Yeteneklerinizi/İlgi alanlarınızı seçin</h3>
    <form method="POST" action="{{ route('quiz_results.submit') }}" id="quizForm">@csrf
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
        <button type="submit" class="btn quiz-btn mt-4">
            Sonuçları Görüntüle
        </button>
    </form>
</div>

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