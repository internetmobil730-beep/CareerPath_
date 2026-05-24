@section('title', 'TÜM BECERİ KATEGORİLERİ')

@extends('dashboard.layout')

@section('content')
<div class="container mt-2">
    <div class="card shadow-lg ">
        <div class="card-body p-5">
        <h2 class="text-xl title p- mb-5">Yetenek Kategorileri</h2>
        <div>
            <a href="{{ route('dashboard.skill_categories.create') }}" class="ekle btn px-8 py-2">Yeni Kategori Ekle</a>
        </div>
    </div>

    <div class="shadow ">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="thead px-5 py-3 text-center">ID</th>
                    <th class="thead px-5 py-3 text-center uppercase">Kategori Adı (TR)</th>
                    <th class="thead px-5 py-3 text-center uppercase">Kategori Adı (EN)</th>
                    <th class="thead px-5 py-3 text-center uppercase">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="px-6 py-4 px-5 py-4 text-center">{{ $category->id }}</td>
                    <td class="px-6 py-4 px-5 py-4 text-center">{{ $category->name }}</td>
                    <td class="px-6 py-4 px-5 py-4 text-center">{{ $category->name }}</td>
                    <td class="px-5 py-4 text-center">
                        <a href="{{ route('dashboard.skill_categories.show', $category->id) }}" class="detay btn px-8 py-2">Detayları Gör</a>
                        <a href="{{ route('dashboard.skill_categories.edit', $category->id) }}" class="düzenle btn px-8 py-2">Düzenle</a>
                        <form action="{{ route('dashboard.skill_categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="sil-uni btn px-8 py-2" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection