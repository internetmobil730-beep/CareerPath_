@section('title', 'BECERİ KATEGORİLERİ DETAYLARI')

@extends('dashboard.layout')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-body p-5">
            <h2 class="title mb-4">Kategori Detayları</h2>

            <div class="mb-4">
                <p><span class="thead">ID:</span> <span class="içerik">{{ $category->id }}</span></p>
                <p><span class="thead">Türkçe Adı:</span class="içerik"> {{ $category->name_tr ?? $category->name }}</span></p>
            </div>

            <hr>

            <div class="shadow overflow-hidden rounded-lg">
                <table class="table min-w-full text-center">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-5 py-3 text-center thead">ID</th>
                            <th class="px-5 py-3 text-center uppercase thead">Yetenek Adı</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($category->skills as $skill)
                        <tr class="border-bottom">
                            <td class="px-5 py-4 text-center içerik">ID: {{ $skill->id }}</td>
                            <td class="px-5 py-4">
                                <div class="text-center içerik">{{ $skill->name_tr ?? $skill->name }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class=" py-4 text-muted">Bu kategori, olan bir beceriyi içermemektedir.
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer p-2  text-end">
            <a href="{{ route('major') }}" class="btn btn-secondary mt-2 me-2">Geri Dön</a>
        </div>
    </div>
</div>
@endsection