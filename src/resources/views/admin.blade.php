<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}" />
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <p class="header-logo">
            FashionablyLate
            </p>
            <form class="form" action="/logout" method="POST">
                @csrf
                <button class="header__nav" >logout</button>
            </form>
        </div>
    </header>

    <main>
        <h2 class="admin-subtitle">Admin</h2>


        <div class="admin-search">
            <form action="/admin" method="GET" >
                <div class="admin-search__title">
                    <input type="text" class="search" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
                </div>

                <div class="admin-search__gender">
                    <select  name="gender" class="gender">
                        <option value="">性別</option>
                        <option value="0" {{ request('gender') == '1' ? 'selected' : '' }}{{ request('gender') == '2' ? 'selected' : '' }}{{ request('gender') == '3' ? 'selected' : '' }}>全て</option>
                        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>

                <div class="admin-search__category">
                    <select  name="category_id" class="category">
                        <option value="">お問い合わせの種類</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-search__date">
                    <input type="date" name="created_at" class="date" value="{{ request('created_at') }}" placeholder="年/月/日">
                </div>

                <div class="admin-search__submit">
                    <button type="submit" class="submit">検索</button>
                </div>

                <div class="admin-search__reset">
                    <a href="/admin" class="reset-button">リセット</a>
                </div>
            </form>
        </div>

        <div >
            {{ $contacts->links('vendor.pagination.custom') }}
        </div>

        <div class="table">
            <table class="admin-table">
                <thead>
                    <tr class="admin-table__header">
                        <th class="th1">お名前</th>
                        <th class="th2">性別</th>
                        <th class="th3">メールアドレス</th>
                        <th class="th3">お問い合わせの種類</th>
                        <th class="th2"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 一覧テーブル内 (94行付近) -->
                    @foreach ($contacts as $contact)
                    <tr>
                        <td class="item">{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                        <td class="item">{{ $contact->gender_text }}</td>
                        <td class="item1">{{ $contact->email }}</td>
                        <td class="item">{{ $contact->category->content }}</td>
                        <td>
                            <button class="detail-button"
                                data-id="{{ $contact->id }}"
                                data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                                data-gender="{{ $contact->gender_text }}"
                                data-email="{{ $contact->email }}"
                                data-tel="{{ $contact->tel }}"
                                data-address="{{ $contact->address }}"
                                data-building="{{ $contact->building }}"
                                data-category="{{ $contact->category->content }}"
                                data-content="{{ $contact->detail }}"
                            >詳細</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            
        </div>
    </main>

    <!-- モーダル全体 -->
<div id="modal" class="modal-overlay">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <table class="modal-table">
            <div class="modal-item">
            <tr class="modal-tr">
                <th class="modal-th">お名前</th>
                <td class="modal-td" id="modal-name"></td>
            </tr>
            </div>
            <tr class="modal-tr">
                <th class="modal-th">性別</th>
                <td class="modal-td" id="modal-gender"></td>
            </tr>
            <tr class="modal-tr">
                <th class="modal-th">メールアドレス</th>
                <td class="modal-td-2" id="modal-email"></td>
            </tr>
            <tr class="modal-tr">
                <th class="modal-th">電話番号</th>
                <td class="modal-td-2" id="modal-tel"></td>
            </tr>
            <tr class="modal-tr">
                <th class="modal-th">住所</th>
                <td class="modal-td" id="modal-address"></td>
            </tr>
            <tr class="modal-tr">
                <th class="modal-th">建物名</th>
                <td class="modal-td" id="modal-building"></td>
            </tr>
            <tr class="modal-tr">
                <th class="modal-th">お問い合わせの種類</th>
                <td class="modal-td" id="modal-category"></td>
            </tr>
            <tr class="modal-tr">
                <th class="modal-th">お問い合わせ内容</th>
                <td class="modal-td" id="modal-detail"></td>
            </tr>
        </table>
        <div class="modal-button">
            <form method="POST" action="{{ route('admin.delete', ['id' => $contact->id]) }}" id="delete-form">
                @csrf
                @method('DELETE')
            <button class="delete-button">削除</button>
            </form>
        </div>
    </div>
</div>



<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal');
    const closeButton = modal.querySelector('.close-button');

    // 詳細ボタン全取得
    document.querySelectorAll('.detail-button').forEach(button => {
        button.addEventListener('click', () => {
            // 各データを取得してモーダルにセット
            document.getElementById('modal-name').textContent = button.dataset.name;
            document.getElementById('modal-gender').textContent = button.dataset.gender;
            document.getElementById('modal-email').textContent = button.dataset.email;
            document.getElementById('modal-tel').textContent = button.dataset.tel;
            document.getElementById('modal-address').textContent = button.dataset.address;
            document.getElementById('modal-building').textContent = button.dataset.building;
            document.getElementById('modal-category').textContent = button.dataset.category;
            document.getElementById('modal-detail').textContent = button.dataset.content;

            // モーダルを表示
            modal.style.display = 'block';

            deleteForm.action = `/admin/delete/${data.id}`;

            modal.style.display = 'flex';
        });
    });

    // 閉じるボタン
    closeButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // モーダル外をクリックした場合に閉じる
    window.addEventListener('click', (e) => {
        if (e.target === modal) modal.style.display = 'none';
    });
});

const modal = document.getElementById('modal');
  const openBtn = document.getElementById('openModal');
  const closeBtn = document.getElementById('closeModal');

  openBtn.onclick = () => modal.style.display = 'flex';
  closeBtn.onclick = () => modal.style.display = 'none';


</script>
</body>

</html>

