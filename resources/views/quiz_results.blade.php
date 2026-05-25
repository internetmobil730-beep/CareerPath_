@section('title','Test_Sonuçları')
@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="mb-4 mt-5 title">Size En Uygun Bölümler (Sonuçlar)</h2>
    <div class="row">
        @forelse($matchingMajors->unique('name') as $major)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-lg">
                <div class="card-body text-center">
                    <h5 class="title">{{ $major->name }}</h5>
                    <p>
                        {{ Str::limit($major->description) }}
                    </p>
                    <a href="{{ route('major_details_public', $major->id) }}" class="detayuni btn btn-warning">
                        Detayları Gör
                    </a>
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