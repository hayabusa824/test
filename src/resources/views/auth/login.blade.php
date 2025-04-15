@extends('layouts.app2')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')


  <main class="main">
    <h2 class="main-title">Login</h2>

    <div class="login-box">
        <form action="/login" method="POST" class="login-form">
        @csrf
        <div class="form">
            <div class="form-group">
                <div class="form-text">
                    <label  for="email">メールアドレス</label>
                </div>
                <input type="email"  name="email" placeholder="例: test@example.com" class="form-input">
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
                <input type="password"  name="password" placeholder="例: coachtech1106" class="form-input">
                @error('password')
                    <div class="form_error">
                    {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="login-button">
            <button type="submit" class="login-button__text">ログイン</button>
        </div>

        </form>
    </div>
  </main>
@endsection