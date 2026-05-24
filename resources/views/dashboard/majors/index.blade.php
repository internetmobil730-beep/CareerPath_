@section('title', 'TÜM BÖLÜMLER')
@extends('dashboard.layout')
@section('content')
<div class="box container-fluid mt-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg w-full max-w-full overflow-hidden">
                <div class="card-body p-4">
                    <h2 class="text-xl title p-2 mb-4">Tüm Bölümler</h2>
                    <div>
                        <a href="{{ route('dashboard.majors.create') }}" class="ekle btn px-4 py-2">Yeni Bölüm Ekle</a>
                    </div>
                </div>

                <div class="table-responsive shadow">
                    <table class="table table-sm min-w-full w-100 custom-table">
                        <thead>
                            <tr>
                                <th style="width: 8%;" class="thead p-2 text-center">ID</th>
                                <th style="width: 32%;" class="thead p-2 text-center uppercase">Bölüm Adı</th>
                                <th style="width: 15%;" class="thead p-2 text-center uppercase">Derece</th>
                                <th style="width: 15%;" class="thead p-2 text-center uppercase">Eğitim Dilleri</th>
                                <th style="width: 30%;" class="thead p-2 text-center uppercase">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($majors as $major)
                            <tr>
                                <td class="p-2 text-center align-middle font-weight-bold">{{ $major->id }}</td>
                                <td class="p-2 text-center align-middle">
                                    <div class="bölüm-text">{{ $major->name}}</div>
                                </td>
                                <td class="p-2 text-center uppercase align-middle text-secondary">
                                    {{ str_replace('_', ' ', $major->degree_type) }}
                                </td>
                                <td class="p-2 text-center uppercase align-middle text-secondary">
                                    {{ str_replace('_', ' ', $major->education_language) }}
                                </td>
                                <td class="p-2 text-center align-middle">
                                    <div class="d-flex justify-content-center align-items-center gap-1 text-nowrap custom-btn-group">
                                        <a href="{{ route('dashboard.majors.show', $major->id) }}"
                                            class="detay btn px-3 py-1-5">Detayları Gör</a>
                                        <a href="{{ route('dashboard.majors.edit', $major->id) }}"
                                            class="düzenle btn px-3 py-1-5">Düzenle</a>
                                        <form action="{{ route('dashboard.majors.destroy', $major->id) }}" method="POST"
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
            </div>
        </div>
    </div>
</div>
@endsection