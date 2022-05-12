@if (count($users) > 0)
    <ul>
        @foreach ($users as $user)
            <li>
                {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                <img src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
                <div>
                    <div>{{-- ユーザの名前 --}}
                        {{ $user->name }}
                    </div>
                    <div>
                        {{-- ユーザ詳細ページへのリンク --}}
                        <a href="{{asset('users/show/' . $user->id, ['user' => $user->id])}}">ユーザ詳細</a>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endif
