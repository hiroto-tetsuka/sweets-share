<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>スイーツシェア</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{asset('css/sweetsshare.css')}}">
    </head>
    
    <body>
        {{-- ヘッダー --}}
        <header id="pageTop">
            <div class="headerNav">
                {{-- トップページへのリンク --}}
                <div class="logo">
                    <a href="/"><img src="{{asset('img/logo.png')}}" alt="logo"></a>
                </div>
                <div class="headerMenu">
                    <ul class="navbarNav">
                        @if (Auth::check())
                            <div>
                                {{-- ユーザ一覧 --}}
                                <li class="navbarItem"><a href="{{asset('users/index')}}">ユーザ一覧</a></li>
                            </div>
                            <div>
                                {{-- 投稿ボタン --}}
                                <li class="navbarItem"><a href="{{asset('posts/create')}}">投稿</a></li>
                            </div>
                            <div>
                                {{-- マイページ --}}
                                <li class="navbarItem"><a href="{{asset('users/show/' . Auth::id())}}">マイページ</a></li>
                            </div>
                        @else
                            <div>
                                {{-- 新規登録ページへのリンク --}}
                                <li class="navbarItem"><a href="{{asset('signup')}}">新規登録</a></li>
                            </div>
                            <div>
                                {{-- ログインページへのリンク --}}
                                <li class="navbarItem"><a href="{{asset('login')}}">ログイン</a></li>
                            </div>
                        @endif
                    </ul>
                </div>
            </div>
        </header>
        
        {{-- コンテンツ --}}
        <div class="container">
            {{-- エラーメッセージ --}}
            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                    <div class="errorMessage">
                        <li>{{ $error }}</li>
                    </div>
                    @endforeach
                </ul>
            @endif
            {{-- コンテンツ --}}
            @yield('content')
        </div>
        
        {{-- フッター --}}
        <footer>
            <a href="#pageTop" class="pageTopBtn">△</a>
        </footer>
    </body>
</html>