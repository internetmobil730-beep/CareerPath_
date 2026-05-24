@section('title', 'TÜM BECERİ KATEGORİLERİ')

@extends('dashboard.layout')

@section('content')
<div class="box container-fluid mt-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg w-full max-w-full overflow-hidden">
                <div class="card-body p-4">
                    <h2 class="text-xl title p-2 mb-4">Yetenek Kategorileri</h2>
                    <div>
                        <a href="{{ route('dashboard.skill_categories.create') }}" class="ekle btn px-4 py-2">Yeni Kategori Ekle</a>
                    </div>
                </div>

                <div class="table-responsive shadow">
                    <table class="table table-sm min-w-full w-100 custom-table">
                        <thead>
                            <tr>
                                <th style="width: 10%;" class="thead p-2 text-center">ID</th>
                                <th style="width: 30%;" class="thead p-2 text-center uppercase">Kategori Adı (TR)</th>
                                <th style="width: 30%;" class="thead p-2 text-center uppercase">Kategori Adı (EN)</th>
                                <th style="width: 30%;" class="thead p-2 text-center uppercase">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td class="p-2 text-center align-middle font-weight-bold">{{ $category->id }}</td>
                                <td class="p-2 text-center align-middle">{{ $category->name }}</td>
                                <td class="p-2 text-center align-middle">{{ $category->name }}</td> <td class="p-2 text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center gap-1 text-nowrap custom-btn-group">
                                        <a href="{{ route('dashboard.skill_categories.show', $category->id) }}" 
                                           class="detay btn px-3 py-1-5">Detayları Gör</a>
                                        <a href="{{ route('dashboard.skill_categories.edit', $category->id) }}" 
                                           class="düzenle btn px-3 py-1-5">Düzenle</a>
                                        <form action="{{ route('dashboard.skill_categories.destroy', $category->id) }}" method="POST" 
                                              class="d-inline m-0">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="sil-uni btn px-3 py-1-5" 
                                                    onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</button>
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