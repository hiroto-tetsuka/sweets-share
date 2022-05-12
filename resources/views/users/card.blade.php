<div>
    <div>
        <h3>{{ $user->name }}</h3>
    </div>
    <div>
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <img src="{{ Gravatar::get($user->email, ['size' => 100]) }}" alt="">
    </div>
</div>

{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')

{{-- ログアウトボタン --}}
@if(Auth::id() == $user->id)
    <a href="{{asset('/logout')}}" method="get">ログアウト</a>
@endif