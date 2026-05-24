@extends('layouts.app')
@section('title','GİRİŞ YAP')
@section('content')
<div class="box row justify-content-center">
  <div class="col-md-6">
    <div class="card p-5 shadow-lg">
      <h1 class="title text-center mb-5 mt-4">Giriş Yap</h1>
      
      @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf 
        
        <input type="email" name="email" class="form-control mb-5" placeholder="E-posta" required>
        
        <div class="input-group mb-5" style="position: relative;">
          <input type="password" name="password" id="password" class="form-control" placeholder="Şifre" required style="padding-right: 45px;">
          <button type="button" id="togglePassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; z-index: 10; cursor: pointer; padding: 0; display: flex; align-items: center;">
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6c757d" style="width: 22px; height: 22px;">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
          </button>
        </div>

        <button class="btn w-100 mb-4">Giriş</button>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.querySelector('#password');
    const togglePasswordButton = document.querySelector('#togglePassword');
    const eyeIcon = document.querySelector('#eyeIcon');

    // كود الأيقونة المشطوبة (إخفاء)
    const eyeSlashPath = `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12c1.388 4.177 5.323 7.178 9.963 7.178 2.115 0 4.095-.58 5.791-1.587M16.883 16.883A7.47 7.47 0 0 1 12 18.25c-3.48 0-6.475-2.257-7.517-5.383A7.44 7.44 0 0 1 6 12c0-.362.025-.72.075-1.071M19.38 15.62A10.44 10.44 0 0 0 21.934 12c-1.388-4.177-5.323-7.178-9.963-7.178a10.473 10.473 0 0 0-2.41.28M9 9l6 6M12 9a3 3 0 0 0-3 3M12 15a3 3 0 0 0 3-3" />`;
    
    // كود الأيقونة المفتوحة (إظهار)
    const eyeOpenPath = `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />`;

    togglePasswordButton.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      
      // تبديل مسار الأيقونة بناءً على حالة الحقل
      eyeIcon.innerHTML = type === 'password' ? eyeOpenPath : eyeSlashPath;
    });
  });
</script>
@endsection