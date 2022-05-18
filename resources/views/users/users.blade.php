@if (count($users) > 0)
    <ul class="indexUserCard">
        @foreach ($users as $user)
            <li class="userInfo">
                <a href="{{asset('users/show/' . $user->id, ['user' => $user->id])}}">
                    <div class="index_flex">
                        @if($user->user_icon == null)
                            <div class="indexUserIcon">
                                {{-- デフォルトユーザアイコン --}}
                                <img src="{{asset('storage/default_icon.png')}}" alt="">
                            </div>
                        @else
                            <div class="indexUserIcon">
                                {{-- ユーザアイコン --}}
                                <img src="{{Storage::url('/user_icon/' . $user->user_icon)}}" alt="">
                            </div>
                        @endif
                        
                        <div class="indexUserName">
                            {{-- ユーザの名前 --}}
                            {{ $user->name }}
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
@endif
