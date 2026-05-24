@section('title', 'TÜM BECERLER')

@extends('dashboard.layout')

@section('content')
<div class="container mt-2">
    <div class="card shadow-lg">
    <div class="card-body p-5">
        <h2 class="text-xl title p-2">Yetenek Listesi</h2>
        <a href="{{ route('dashboard.skills.create') }}" class="ekle btn px-8 py-2 my-5 mx-5">Yeni Yetenek Ekle</a>
    </div>
    
    <div class="shadow">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="thead px-5 py-3 text-center">ID</th>
                    <th class="thead px-5 py-3 text-center">Yetenek Adı</th>
                    <th class="thead px-5 py-3 text-center">Kategori</th>
                    <th class="thead px-5 py-3 text-center">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($skills as $skill)
                <tr>
                    <td class="px-5 py-4 text-center">{{ $skill->id }}</td>
                    <td class="px-5 py-4 text-center">{{ $skill->name }}</td>
                    <td class="px-5 py-4 text-center">{{ $skill->category->name}}</td>
                    <td class="px-5 py-4 text-center">
                        <a href="{{ route('dashboard.skills.show', $skill->id) }}" class="detay btn px-8 py-2">Detayları Gör</a>
                        <a href="{{ route('dashboard.skills.edit', $skill->id) }}" class="düzenle btn px-8 py-2">Düzenle</a>
                        <form action="{{ route('dashboard.skills.destroy', $skill->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="sil-uni btn px-8 py-2" onclick="return confirm('Emin misiniz?')">Sil</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
@endsection