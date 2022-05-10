<header>
    <nav class="header-nav">
        {{-- トップページへのリンク --}}
        <a class="nav-logo" href="/"><img src="{{asset('img/logo.png')}}"></a>
{{--
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
--}}
{{--        <div class="collapse navbar-collapse" id="nav-bar">--}}
{{--            <ul class="navbar-nav mr-auto"></ul>--}}
            <ul class="navbar-nav">
                @if (Auth::check())
                    {{-- ユーザ一覧 --}}
                    <li class="nav-item">{!! link_to_route('users.index', 'ユーザ一覧', [], ['class' => 'nav-link']) !!}</li>
                    {{-- 投稿ボタン --}}
                    <li class="nav-item">{!! link_to_route('posts.create', '投稿', [], ['class' => 'nav-link']) !!}</li>
                    {{-- マイページ --}}
                    <li class="nav-item">{!! link_to_route('users.show', 'マイページ', ['user' => Auth::id()], ['class' => 'nav-link']) !!}</li>
                @else
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', '新規登録', [], ['class' => 'nav-link']) !!}</li>
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
{{--        </div>--}}
    </nav>
</header>