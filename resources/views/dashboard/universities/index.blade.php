@section('title', 'TÜM ÜNİVERSİTELER')

@extends('dashboard.layout')

@section('content')
<div class="box container-fluid mt-2">
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
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg w-full max-w-full overflow-hidden">
                <div class="card-body p-4">
                    <h2 class="text-xl title p-2 mb-4">Üniversite Listesi</h2>
                    <div>
                        <a href="{{ route('dashboard.universities.create') }}" class="ekle btn px-4 py-2">Yeni Üniversite Ekle</a>
                    </div>
                </div>
                
                <div class="table-responsive shadow">
                    <table class="table table-sm min-w-full w-100 custom-table">
                        <thead>
                            <tr>
                                <th style="width: 7%;" class="thead p-2 text-center">ID</th>
                                <th style="width: 28%;" class="thead p-2 text-center">Üniversite Adı</th>
                                <th style="width: 15%;" class="thead p-2 text-center">Tür</th>
                                <th style="width: 20%;" class="thead p-2 text-center">Konum</th>
                                <th style="width: 30%;" class="thead p-2 text-center uppercase">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($universities as $uni)
                            <tr>
                                <td class="p-2 text-center align-middle font-weight-bold">{{ $uni->id }}</td>
                                <td class="p-2 text-center align-middle font-weight-bold">{{ $uni->name }}</td>
                                <td class="p-2 text-center align-middle font-weight-bold">
                                    <span class="px-2">{{ strtoupper($uni->type) }}</span>
                                </td>
                                <td class="p-2 text-center align-middle font-weight-bold">
                                    {{ $uni->district }} / {{ $uni->side }}
                                </td>
                                <td class="p-2 text-center align-middle font-weight-bold">
                                    <div class="d-flex justify-content-center align-items-center gap-1 text-nowrap custom-btn-group">
                                        <a href="{{ route('dashboard.universities.show', $uni->id) }}" 
                                           class="detay btn px-3 py-1-5">Detayları Gör</a>
                                        <a href="{{ route('dashboard.universities.edit', $uni->id) }}" 
                                           class="düzenle btn px-3 py-1-5">Düzenle</a>
                                        <form action="{{ route('dashboard.universities.destroy', $uni->id) }}" method="POST" 
                                              class="d-inline m-0">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="sil-uni btn px-3 py-1-5" 
                                                    onclick="return confirm('Emin misiniz?')">Sil</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> </div>
    </div>
</div>
@endsection