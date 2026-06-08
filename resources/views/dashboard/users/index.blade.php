@section('title', 'TÜM KULLANICILAR')

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

                <div class="header_icons flex-shrink-0">
                    <div class="icon favorite-trigger">
                        <a href="#" class="d-block text-decoration-none">
                            <i class="fa-regular fa-heart custom-heart-icon"></i>
                            <span class="count count_favourite">0</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg w-full max-w-full overflow-hidden">
                <div class="card-body p-4">
                    <h3 class="text-xl title p-2">Sistemdeki Kullanıcılar</h3>
                </div>
                
                <div class="table-responsive shadow">
                    <table class="table table-sm table-bordered text-center table-striped min-w-full w-100 custom-table">
                        <thead>
                            <tr>
                                <th style="width: 8%;" class="thead p-2 uppercase">ID</th>
                                <th style="width: 22%;" class="thead p-2 uppercase">İsim</th>
                                <th style="width: 25%;" class="thead p-2 uppercase">E-posta</th>
                                <th style="width: 20%;" class="thead p-2 uppercase">Kayıt Tarihi</th>
                                <th style="width: 25%;" class="thead p-2 uppercase">İşlemler</th> </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td class="p-2 align-middle font-weight-bold içerik font-weight-bold">{{ $user->id }}</td>
                                <td class="p-2 align-middle font-weight-bold içerik font-weight-bold">{{ $user->name }}</td>
                                <td class="p-2 align-middle font-weight-bold içerik font-weight-bold">{{ $user->email }}</td>
                                <td class="p-2 align-middle font-weight-bold içerik font-weight-bold">{{ $user->created_at->format('Y-m-d') }}</td>
                                <td class="p-2 align-middle font-weight-bold font-weight-bold">
                                    <div class="d-flex justify-content-center align-items-center gap-1 text-nowrap custom-btn-group font-weight-bold">
                                        <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-sm userbtn1 px-3 py-1-5">
                                            Düzenle
                                        </a>
                                        
                                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" class="d-inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm userbtn2 px-3 py-1-5" onclick="return confirm('Emin misiniz?')">
                                                Sil
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">Henüz kullanıcı bulunamadı.</td> </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection