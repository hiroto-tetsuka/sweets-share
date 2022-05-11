<header>
    <nav class="header-nav">
        {{-- トップページへのリンク --}}
        <a href="/"><img src="{{asset('img/logo.png')}}" class="nav-logo" alt=""></a>
        <ul class="navbar-nav">
            @if (Auth::check())
                {{-- ユーザ一覧 --}}
                <a href="{{asset('')}}" class="nav-link">ユーザ一覧</a>
                <li>{!! link_to_route('users.index', 'ユーザ一覧', [], ['class' => 'nav-link']) !!}</li>
                {{-- 投稿ボタン --}}
                <li>{!! link_to_route('posts.create', '投稿', [], ['class' => 'nav-link']) !!}</li>
                {{-- マイページ --}}
                <li>{!! link_to_route('users.show', 'マイページ', ['user' => Auth::id()], ['class' => 'nav-link']) !!}</li>
            @else
                {{-- 新規登録ページへのリンク --}}
                <li><a href="{{asset('signup')}}" class="nav-link">新規登録</a></li>
                {{-- ログインページへのリンク --}}
                <li><a href="{{asset('login')}}" class="nav-link">ログイン</a></li>
                
            @endif
        </ul>
    </nav>
</header>