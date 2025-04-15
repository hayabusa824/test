@extends('layouts.app')

  @section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
  @endsection

  @section('content')

  <main>
    <div class="confirm__content">
      <div class="confirm__heading">
        <h2>Confirm</h2>
      </div>
      <form class="form" action="/thanks" method="post">
        @csrf
        <div class="confirm-table">
          <table class="confirm-table__inner">
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お名前</th>
              <td class="confirm-table__text-2">
                <input type="text" name="last_name" value="{{ $contact['last_name']}}" readonly />
                <input type="text" name="first_name" value="{{ $contact['first_name']}}" readonly/>
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">性別</th>
              <td class="confirm-table__text">
                @php
                  $genderText = [
                      '1' => '男性',
                      '2' => '女性',
                      '3' => 'その他',
                  ];
                @endphp
                <input type="gender"  value="{{ $genderText[$contact['gender']] ?? '不明'}}" readonly/>
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
              </td> 
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">メールアドレス</th>
              <td class="confirm-table__text-3">
                <input type="email" name="email" value="{{ $contact['email']}}"readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">電話番号</th>
              <td class="confirm-table__text-2">
                <input type="text" name="tel_1" value="{{ $contact['tel_1']}}" readonly/>
                <input type="text" name="tel_2" value="{{ $contact['tel_2']}}" readonly/>
                <input type="text" name="tel_3" value="{{ $contact['tel_3']}}" readonly/>
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">住所</th>
              <td class="confirm-table__text">
                <input type="address" name="address" value="{{ $contact['address']}}"readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">建物名</th>
              <td class="confirm-table__text">
                <input type="building" name="building" value="{{ $contact['building']}}" readonly/>
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせの種類</th>
              <td class="confirm-table__text">
                @php
                  $categoryText = [
                      '1' => '商品のお届けについて',
                      '2' => '商品の交換について',
                      '3' => '商品トラブル',
                      '4' => 'ショップへのお問い合わせ',
                      '5' => 'その他',
                  ];
                @endphp
                <input type="content"  value="{{ $categoryText[$category['category_id']] ?? '不明' }}"readonly />
                <input type="hidden" name="category_id" value="{{ $category['category_id'] }}">
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせ内容</th>
              <td class="confirm-table__text">
                <textarea name="detail" readonly class="confirm-table_textarea">{{ $contact['detail'] }}</textarea>
              </td>
            </tr>
          </table>
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">送信</button>
          <button class="form__button-back" type="button" onclick="history.back()">修正</button>
        </div>
      </form>
    </div>
  </main>
  @endsection

</html>
