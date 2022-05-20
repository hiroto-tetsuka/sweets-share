<ul class="navtab">
    {{-- 自分の投稿一覧タブ --}}
    <li class="navItem">
        <a href="{{asset('users/show/' . Auth::id())}}">投稿</a>
        <span>{{ $user->posts_count }}</span>
    </li>
    
    {{-- フォロー一覧タブ --}}
    <li class="navItem">
        <a href="{{asset('/users/'.$user->id.'/followings')}}" method="post">フォロー</a>
        <span>{{ $user->followings_count }}</span>
    </li>
    
    {{-- フォロワー一覧タブ --}}
    <li class="navItem">
        <a href="{{ asset('/users/'.$user->id.'/followers')}}" method="post">フォロワー</a>
        <span>{{ $user->followers_count }}</span>
    </li>
    
    {{-- いいね一覧タブ --}}
    <li class="navItem">
        <a href="{{ asset('/users/'.$user->id.'/favorites')}}" method="post">いいね</a>
        <span>{{ $user->favorites_count }}</span>
    </li>
    
</ul>