@extends('layouts.app')
@section('title','YENİ KAYIT')
@section('content')
<div class="box2 row justify-content-center">
  <div class="col-md-6">
    <div class="card p-5 shadow-lg">
      <h1 class="title text-center mb-4 mt-4">Yeni Hesap Kaydı</h1>
      
      @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ url('/register') }}">
        @csrf
        
        <input type="text" name="name" class="form-control mb-4" placeholder="Ad Soyad" value="{{ old('name') }}" required>
        
        <input type="email" name="email" class="form-control mb-4" placeholder="E-posta" value="{{ old('email') }}" required>
        
        <div class="input-group mb-4" style="position: relative;">
          <input type="password" name="password" id="password" class="form-control" placeholder="Şifre" required style="padding-right: 45px;">
          <button type="button" id="togglePassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; z-index: 10; cursor: pointer; color: #6c757d;">
            👁️
          </button>
        </div>

        <div class="input-group mb-4" style="position: relative;">
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Şifreyi Onayla" required style="padding-right: 45px;">
          <button type="button" id="toggleConfirmPassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; z-index: 10; cursor: pointer; color: #6c757d;">
            👁️
          </button>
        </div>

        <button class="btn w-100 mb-4">Kayıt Ol</button>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // 1. الحقل الأساسي
    const passwordInput = document.querySelector('#password');
    const togglePasswordButton = document.querySelector('#togglePassword');

    togglePasswordButton.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.textContent = type === 'password' ? '👁️' : '🙈';
    });

    // 2. حقل التأكيد
    const confirmInput = document.querySelector('#password_confirmation');
    const toggleConfirmButton = document.querySelector('#toggleConfirmPassword');

    toggleConfirmButton.addEventListener('click', function () {
      const type = confirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
      confirmInput.setAttribute('type', type);
      this.textContent = type === 'password' ? '👁️' : '🙈';
    });
  });
</script>
@endsection