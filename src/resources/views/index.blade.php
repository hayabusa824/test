@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<body>

  <div class="main-logo">
    <p>contact</p>
  </div>


  <form class='form' action="/confirm" method="post"  novalidate>
    @csrf
    <div class="form-item">
      <div class='form__text'>お名前 ※</div>
      <div class="form__recode">
        <div class='form-name__text'>
          <input  type="text" name="last_name" class="form-txt"  placeholder="例: 山田" value="{{ old('last_name') }}" >
        </div>
        <div class='form-name__text'>
          <input  type="text" name="first_name"   class="form-txt"  placeholder="例: 太郎" value="{{ old('first_name') }}" >
        </div>
      </div>
    </div>
    <div class="error">
      @error('last_name')
      <div class="form_error">
        {{ $message }}
      </div>
        @enderror
        @error('first_name')
        <div class="form_error-2">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>

    <div class="form-item">
      <div class='form__text'>性別 ※</div>
      <div class="form__recode">
        <div class="form-sex_1">
          <input  type="radio" name="gender" class="form-txt" value="1" @if(old('gender') == 1)  @endif checked>男性
        </div>
        <div class="form-sex_1">
          <input  type="radio" name="gender" class="form-txt" value="2" @if(old('gender') == 2)  @endif>女性
        </div>
        <div class="form-sex_1">
          <input  type="radio" name="gender" class="form-txt" value="3" @if(old('gender') == 3)  @endif>その他
        </div>
      </div>
        @error('gender')
        <div class="form_error">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>

    <div class="form-item">
      <div class='form__text'>メールアドレス ※</div>
      <div class='form__recode'>
        <input type="email" name="email" class="form-txt"   placeholder="例: test@example.com" value="{{ old('email') }}" >
      </div>
    </div>
    <div class="error">
      @error('email')
      <div class="form_error">
        {{ $message }}
      </div>
      @enderror
    </div>
    </div>

    <div class="form-item">
      <div class='form__text'>電話番号 ※</div>
      <div class='form__recode'>
        <div class='form-tel_txt-1'>
          <input type="text" name="tel_1"  class="form-txt"  placeholder= "080" value="{{ old('tel_1') }}" >
        </div>
        <div >ー</div>
        <div class='form-tel_txt-2'>
          <input type="text" name="tel_2"  class="form-txt"  placeholder= "1234" value="{{ old('tel_2') }}">
        </div>
        <div >ー</div>
        <div class='form-tel_txt-3'>
          <input type="text" name="tel_3"  class="form-txt"  placeholder= "5678" value="{{ old('tel_3') }}" >
        </div>
      </div>
    </div>
    <div class="error">
      @if ($errors->has('tel_1') || $errors->has('tel_2') || $errors->has('tel_3'))
  <div class="form_error" >
    @if ($errors->has('tel_1'))
      {{ $errors->first('tel_1') }}
    @elseif ($errors->has('tel_2'))
      {{ $errors->first('tel_2') }}
    @elseif ($errors->has('tel_3'))
      {{ $errors->first('tel_3') }}
    @endif
  </div>
@endif
    </div>
  </div>
  

    <div class="form-item">
      <div class='form__text'>住所 ※</div>
      <div class='form__recode'>
        <input type="text" name="address"  class="form-txt"  placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" >
      </div>
      </div>
      <div class="error">
        @error('address')
        <div class="form_error">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>

    <div class="form-item">
      <div class='form__text'>建物名</div>
        <div class='form__recode'>
          <input type="text" name="building" class="form-txt"   placeholder="例: 千駄ヶ谷マンション101" >
        </div>
      </div>
    </div>

    <div class="form-item">
      <div class='form__text'>お問い合わせの種類 ※</div>
      <div class='form__recode'>
        <select name="category_id" >
          <option value="" >選択してください</option>
          @foreach ($categories as $category)
          <option class="form-txt"  value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category['content'] }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="error">
        @error('category_id')
        <div class="form_error">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>

    <div class="form-item2">
      <div class='form__text'>お問い合わせ内容 ※</div>
      <div class='form__recode'>
        <textarea name="detail" class="form-textarea" placeholder="お問い合わせ内容をご記載ください" value="{{ old('detail') }}" ></textarea>
      </div>
    </div>
      <div class="error">
        @error('detail')
        <div class="form_error">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>

    
    <div class='form-button'>
      <button type="submit">確認画面</button>
    </div>
    
  </form>

</body>
@endsection