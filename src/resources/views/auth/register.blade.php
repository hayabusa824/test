@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')



  <main class="main">
    <h2 class="main-title">Register</h2>

    <div class="register-box">
      <form action="/register" method="POST" class="register-form">
        @csrf
        <div class="form">
          <div class="form-group">
            <div class="form-text">
            <label  for="name">お名前</label>
            </div>
            <input type="text"  name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎" class="form-input">
            @error('name')
              <div class="form_error">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group">
            <div class="form-text">
              <label  for="email">メールアドレス</label>
            </div>
            <input type="email"  name="email" value="{{ old('email') }}" placeholder="例: test@example.com" class="form-input">
            @error('email')
              <div class="form_error">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group">
            <div class="form-text">
              <label for="password">パスワード</label>
            </div>
            <input type="password"  name="password" value="{{ old('password') }}" placeholder="例: coachtech1106" class="form-input">
            @error('password')
              <div class="form_error">
                {{ $message }}
              </div>
            @enderror
          </div>
        </div>

        <div class="register-button">
        <button type="submit" class="register-button__text" >登録</button>
        </div>

      </form>
    </div>
  </main>


</html>
@endsection