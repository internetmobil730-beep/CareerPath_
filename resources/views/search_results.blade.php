@extends('layouts.app') 
@section('title','Arama Sonuçları')
@section('content')
<div class="container mt-5">
    <h2>"{{ $query }}" İçin Arama Sonuçları</h2>
    <hr>

    <div class="row mt-4">
        <div class="col-md-12">
            <h4><i class="bi bi-book"></i> Mevcut Bölümler</h4>
            @if($majors->isEmpty())
                <p class="text-muted">Bu isimle eşleşen herhangi bir bölüm bulunamadı.</p>
            @else
                <div class="list-group">
                    @foreach($majors as $major)
                        <a href="{{ route('major.details', $major->id) }}" class="list-group-item list-group-item-action">
                            <h5>{{ $major->name }}</h5>
                            <p class="mb-1 text-secondary">{{ Str::limit($major->description, 150) }}</p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h4><i class="bi bi-building"></i> Mevcut Üniversiteler</h4>
            @if($universities->isEmpty())
                <p class="text-muted">Bu isimle eşleşen herhangi bir üniversite bulunamadı.</p>
            @else
                <div class="list-group">
                    @foreach($universities as $uni)
                        <a href="{{ route('universities.show', $uni->id) }}" class="list-group-item list-group-item-action">
                            <h5>{{ $uni->name }}</h5>
                            <p class="mb-1 text-secondary">{{ $uni->location }}</p> 
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection