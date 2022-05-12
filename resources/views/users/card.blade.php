<div>
    <div>
        {{-- ユーザの名前 --}}
        <h3>{{ $user->name }}</h3>
    </div>
    <div>
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <img src="{{ Gravatar::get($user->email, ['size' => 100]) }}" alt="">
    </div>
</div>

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

{{-- ログアウトボタン --}}
@if(Auth::id() == $user->id)
    <a href="{{asset('/logout')}}" method="get">ログアウト</a>
@endif