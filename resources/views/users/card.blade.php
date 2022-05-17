<div class="mypage">
    <div>
        <div class="showUserIcon">
            {{-- ユーザアイコン --}}
            <img src="{{Storage::url('/user_icon/' . $user->user_icon)}}" alt="">
        </div>
        
        {{-- ログイン中のidが詳細を表示しているユーザのidと等しければアイコン画像編集ボタンを表示 --}}
        @if(Auth::id() == $user->id)
            <div class="editUserIcon">
                <a href="{{url('/edit')}}">
                    アイコン画像を編集
                </a>
            </div>
        @endif
        
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
            <form action="{{asset('/logout')}}" method="post">
                @csrf
                <input type="submit" id="logout" value="ログアウト">
            </form>
        @endif
    </div>
</div>