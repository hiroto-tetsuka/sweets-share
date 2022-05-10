<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>スイーツシェア</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{asset('css/sweetsshare.css')}}">
    </head>
    
    <body>
        {{-- ナビゲーションバー --}}
        @include('commons.navbar')
        <div class="container">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')
            {{-- コンテンツ --}}
            @yield('content')
        </div>
        {{-- フッター --}}
        <footer>
            <p>画面上部に戻るボタンを表示したい</p>
        </footer>
    </body>
</html>