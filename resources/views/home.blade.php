@extends('layouts.app')
@section('title','ANA SAYFA')
@section('content')
<div class="d-flex flex-column align-items-center text-center">
    <div class="col-8 col-sm-6 col-md-4 col-lg-3 mt-5">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid rounded-circle shadow-sm mt-5 mb-3">
    </div>
  <h1 class="title display-5 mb-3 mt-2">CareerPath'a hoşgeldiniz</h1>
  <p class="lead">Hobilerinizi ve ilgi alanlarınızı seçin, sizin için uygun üniversite bölümünü önerelim.</p>
  <div >
    @guest
      <a href="{{ route('login') }}" class="btn btn-primary me-2 mt-3">GİRİŞ YAP</a>
      <a href="{{ route('register') }}" class="btn btn-primary mt-3">YENİ KAYIT</a>
    @else
      <a href="{{ route('quiz') }}" class="btn btn-primary mt-3">QUİZE BAŞLA</a>
    @endguest
  </div>
</div>
@endsection