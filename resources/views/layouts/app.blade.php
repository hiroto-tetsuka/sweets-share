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
        <header>
            <nav class="header-nav">
                {{-- トップページへのリンク --}}
                <a href="/"><img src="{{asset('img/logo.png')}}" class="nav-logo" alt=""></a>
                <ul class="navbar-nav">
                    @if (Auth::check())
                        {{-- ユーザ一覧 --}}
                        <li><a href="{{asset('users/index')}}" class="nav-link">ユーザ一覧</a></li>
                        {{-- 投稿ボタン --}}
                        <li><a href="{{asset('posts/create')}}" class="nav-link">投稿</a></li>
                        {{-- マイページ --}}
                        <li><a href="{{asset('users/show/' . Auth::id())}}" class="nav-link">マイページ</a></li>
                    @else
                        {{-- 新規登録ページへのリンク --}}
                        <li><a href="{{asset('signup')}}" class="nav-link">新規登録</a></li>
                        {{-- ログインページへのリンク --}}
                        <li><a href="{{asset('login')}}" class="nav-link">ログイン</a></li>
                        
                    @endif
                </ul>
            </nav>
        </header>
        <div class="container">
            {{-- エラーメッセージ --}}
            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            {{-- コンテンツ --}}
            @yield('content')
        </div>
        {{-- フッター --}}
        <footer>
            <p>画面上部に戻るボタンを表示したい</p>
        </footer>
    </body>
</html>