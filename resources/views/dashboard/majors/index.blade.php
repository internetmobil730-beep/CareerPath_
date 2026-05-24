@section('title', 'TÜM BÖLÜMLER')
@extends('dashboard.layout')
@section('content')
<div class="box container-fluid mt-2">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-11">
            <div class="card shadow-lg w-full max-w-full overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-xl title p-2 mb-4">Tüm Bölümler</h2>
                    <div>
                        <a href="{{ route('dashboard.majors.create') }}" class="ekle btn px-4 py-2">Yeni Bölüm Ekle</a>
                    </div>
                </div>

                <div class="table-responsive shadow">
                    <table class="min-w-full w-100 table-layout-fixed">
                        <thead>
                            <tr>
                                <th class="thead px-4 py-3 text-center">ID</th>
                                <th class="thead px-4 py-3 text-center uppercase">Bölüm Adı</th>
                                <th class="thead px-4 py-3 text-center uppercase">Derece</th>
                                <th class="thead px-4 py-3 text-center uppercase">Eğitim Dilleri</th>
                                <th class="thead px-4 py-3 text-center uppercase">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($majors as $major)
                            <tr>
                                <td class="px-4 py-4 text-center align-middle">{{ $major->id }}</td>
                                <td class="px-4 py-4 text-center align-middle">
                                    <div class="font-weight-bold">{{ $major->name}}</div>
                                </td>
                                <td class="px-4 py-4 text-center uppercase align-middle">
                                    <span class="px-2">
                                        {{ str_replace('_', ' ', $major->degree_type) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-center uppercase align-middle">
                                    <span class="px-2">
                                        {{ str_replace('_', ' ', $major->education_language) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-center align-middle">
                                    <div class="d-flex flex-wrap gap-2 justify-content-center align-items-center btn-group-container">
                                        <a href="{{ route('dashboard.majors.show', $major->id) }}"
                                            class="detay btn px-4 py-2 m-1">Detayları Gör</a>
                                        <a href="{{ route('dashboard.majors.edit', $major->id) }}"
                                            class="düzenle btn px-4 py-2 m-1">Düzenle</a>
                                        <form action="{{ route('dashboard.majors.destroy', $major->id) }}" method="POST"
                                            class="d-inline m-1">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="sil-uni btn px-4 py-2"
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