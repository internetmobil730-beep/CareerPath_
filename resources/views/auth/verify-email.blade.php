@extends('layouts.app')
@section('title','Onay Kodu')
@section('content')
<div class="box row justify-content-center">
  <div class="col-md-6">
    <div class="card p-5 shadow-lg">
      <h1 class="title text-center mb-4 mt-4">Hesap Onaylama</h1>
      
      <div class="alert alert-info text-center">
        Lütfen e-posta adresinize gönderilen 6 haneli onay kodunu giriniz.
      </div>

      @if(session('flash_onay_kodu'))
        <div class="alert alert-warning text-center">
          <strong>Sistem Notu (Simülasyon):</strong> Mail sunucusu bağlanamadı. <br>
          Test Kodunuz: <span style="font-size: 18px; color: red; font-weight: bold;">{{ session('flash_onay_kodu') }}</span>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('auth.verify.submit') }}">
        @csrf 
        <input type="text" name="kod" class="form-control mb-4 text-center" placeholder="Onay Kodu" style="font-size: 20px; letter-spacing: 5px;" required>
        <button class="btn w-100 mb-4">Onayla ve Giriş Yap</button>
      </form>
    </div>
  </div>
</div>
@endsection