@section('title', 'TÜM UNİVERSİTELER')

@extends('dashboard.layout')

@section('content')
<div class="container mt-2">
    <div class="card shadow-lg ">
    <div class="card-body p-5">
        <h2 class="text-xl title p-2">Üniversite Listesi</h2>
        <a href="{{ route('dashboard.universities.create') }}" class="ekle btn px-8 py-2 my-5 mx-5">Yeni üniversite Ekle</a>
    </div>
    <div class="shadow">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="thead px-5 py-3 text-center">ID</th>
                    <th class="thead px-6 py-3 text-center">Üniversite Adı</th>
                    <th class="thead px-6 py-3 text-center">Tür</th>
                    <th class="thead px-6 py-3 text-center">Konum</th>
                    <th class="thead px-6 py-3 text-center">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($universities as $uni)
                <tr>
                    <td class="px-5 py-4 text-center">{{ $uni->id }}</td>
                    <td class="px-6 py-4 text-center">{{ $uni->name }}</td>
                    <td class="px-6 py-4 text-center"><span class="px-2">{{ strtoupper($uni->type) }}</span></td><!--  شلت هي الكتابة من الكلاس px-2 py-1 text-xs font-bold rounded -->
                    <td class="px-6 py-4 text-center">{{ $uni->district }} / {{ $uni->side }}</td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('dashboard.universities.show', $uni->id) }}" class="detay btn px-8 py-2">Detayları Gör</a>
                        <a href="{{ route('dashboard.universities.edit', $uni->id) }}" class="düzenle btn px-8 py-2">Düzenle</a>
                        <form action="{{ route('dashboard.universities.destroy', $uni->id) }}" method="POST" class="inline">
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