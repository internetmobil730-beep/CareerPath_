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
        <input type="email" name="email" class="form-control mb-5" placeholder="E-posta">
        <input type="password" name="password" class="form-control mb-5" placeholder="Şifre">
        <button class="btn w-100 mb-4 ">Giriş</button>
      </form>
    </div>
  </div>
</div>
@endsection