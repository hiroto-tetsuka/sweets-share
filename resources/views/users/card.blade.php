<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body">
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <img class="rounded img-fluid" src="{{ Gravatar::get($user->email, ['size' => 100]) }}" alt="">
    </div>
</div>

{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')

{{-- ログアウトボタン --}}
@if(Auth::id() == $user->id)
    <a href="{{route('logout.get')}}" class="btn btn-logout">ログアウト</a>
@endif