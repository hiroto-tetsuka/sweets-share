@if (count($users) > 0)
    <ul class="indexUserCard">
        @foreach ($users as $user)
            <li class="userInfo">
                <a href="{{asset('users/show/' . $user->id, ['user' => $user->id])}}">
                    <div class="indexUserIcon">
                        {{-- ユーザアイコン --}}
                        <img src="{{Storage::url('/user_icon/' . $user->user_icon)}}" alt="">
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
