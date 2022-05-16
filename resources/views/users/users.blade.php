@if (count($users) > 0)
    <ul class="indexUserCard">
        @foreach ($users as $user)
            <li class="userInfo">
                <a href="{{asset('users/show/' . $user->id, ['user' => $user->id])}}">
                    <div class="indexUserIcon">
                        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                        <img src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
                    </div>
                    <div class="indexUserName">
                        {{-- ユーザの名前 --}}
                        {{ $user->name }}
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
@endif
