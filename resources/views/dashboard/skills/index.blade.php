@section('title', 'TÜM BECERİLER')

@extends('dashboard.layout')

@section('content')
<div class="box container-fluid mt-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg w-full max-w-full overflow-hidden">
                <div class="card-body p-4">
                    <h2 class="text-xl title p-2 mb-4">Yetenek Listesi</h2>
                    <div>
                        <a href="{{ route('dashboard.skills.create') }}" class="ekle btn px-4 py-2">Yeni Yetenek Ekle</a>
                    </div>
                </div>
                
                <div class="table-responsive shadow">
                    <table class="table table-sm min-w-full w-100 custom-table">
                        <thead>
                            <tr>
                                <th style="width: 10%;" class="thead p-2 text-center">ID</th>
                                <th style="width: 30%;" class="thead p-2 text-center">Yetenek Adı</th>
                                <th style="width: 30%;" class="thead p-2 text-center">Kategori</th>
                                <th style="width: 30%;" class="thead p-2 text-center uppercase">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($skills as $skill)
                            <tr>
                                <td class="p-2 text-center align-middle font-weight-bold">{{ $skill->id }}</td>
                                <td class="p-2 text-center align-middle">{{ $skill->name }}</td>
                                <td class="p-2 text-center align-middle text-secondary">{{ $skill->category->name }}</td>
                                <td class="p-2 text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center gap-1 text-nowrap custom-btn-group">
                                        <a href="{{ route('dashboard.skills.show', $skill->id) }}" 
                                           class="detay btn px-3 py-1-5">Detayları Gör</a>
                                        <a href="{{ route('dashboard.skills.edit', $skill->id) }}" 
                                           class="düzenle btn px-3 py-1-5">Düzenle</a>
                                        <form action="{{ route('dashboard.skills.destroy', $skill->id) }}" method="POST" 
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