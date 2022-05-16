<div class="mypage">
    <div>
        <div class="showUserIcon">
            {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
            <img src="{{asset('storage/sample.jpeg')}}" alt="">
        </div>
        <div class="mypageUserName">
            {{-- ユーザの名前 --}}
            {{ $user->name }}
        </div>
    </div>
    <div class="followButton">
        {{-- フォロー/アンフォロー --}}
        {{-- ログインしているidがそのユーザのidと等しくなければ --}}
        @if(Auth::id() != $user->id)
            {{-- ログインしているユーザがすでにフォローしていれば --}}
            @if(Auth::user()->is_following($user->id))
                {{-- アンフォローボタンを表示 --}}
                <form action="{{asset('/users/' . $user->id . '/unfollow')}}" method="post">
                    @csrf
                    <input type="submit" id="unfollow" value="アンフォロー">
                </form>
            {{-- ログインしているユーザがまだフォローしていなければ --}}
            @else
                {{-- フォローボタンを表示 --}}
                <form action="{{asset('/users/' . $user->id . '/follow')}}" method="post">
                    @csrf
                    <input type="submit" id="follow" value="フォロー">
                </form>
            @endif
        @endif
    </div>
    <div class="logout">
        {{-- ログアウトボタン --}}
        {{-- ログインしているidがユーザのidと等しければ --}}
        @if(Auth::id() == $user->id)
            {{-- ログアウトボタンを表示 --}}
            <form action="{{asset('/logout')}}" method="get">
                @csrf
                <input type="submit" id="logout" value="ログアウト">
            </form>
        @endif
    </div>
</div>