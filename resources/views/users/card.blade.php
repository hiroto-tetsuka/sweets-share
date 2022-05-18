<div class="mypage">
    <div>
        @if($user->user_icon == null)
            <div class="showUserIcon">
                {{-- デフォルトユーザアイコン --}}
                <img src="{{asset('storage/default_icon.png')}}" alt="">
            </div>
        @else
            <div class="showUserIcon">
                {{-- ユーザアイコン --}}
                <img src="{{Storage::url('/user_icon/' . $user->user_icon)}}" alt="">
            </div>
        @endif
        
        {{-- ログイン中のidが詳細を表示しているユーザのidと等しければアイコン画像編集ボタンを表示 --}}
        @if(Auth::id() == $user->id)
            <div class="editUserIcon">
                <a href="{{url('/edit')}}">アイコン画像を編集</a>
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
                <button class="unfollow_button" value="{{$user->id}}" id="unfollow">アンフォロー</button>
            {{-- ログインしているユーザがまだフォローしていなければ --}}
            @else
                {{-- フォローボタンを表示 --}}
                <button class="follow_button" value="{{$user->id}}" id="follow">フォロー</button>
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

{{-- フォロー --}}
<form class="follow_form" action="{{asset('/users/' . $user->id . '/follow')}}" method="POST">
    @csrf
    <input type="hidden" id="follow_id" name="user_id" value="">
</form>

{{-- アンフォロー --}}
<form class="unfollow_form" action="{{asset('/users/' . $user->id . '/unfollow')}}" method="POST">
    @csrf
    <input type="hidden" id="unfollow_id" name="user_id" value="">
</form>