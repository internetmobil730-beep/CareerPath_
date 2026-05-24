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
          <button type="button" id="togglePassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; z-index: 10; cursor: pointer; color: #6c757d;">
            👁️
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

    togglePasswordButton.addEventListener('click', function () {
      // تبديل نوع الحقل بين password و text
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      
      // تغيير الإيموجي بناءً على الحالة
      this.textContent = type === 'password' ? '👁️' : '🙈';
    });
  });
</script>
@endsection