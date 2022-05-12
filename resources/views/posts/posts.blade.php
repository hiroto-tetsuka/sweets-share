{{-- 投稿が1つ以上あれば --}}
@if (count($posts) > 0)
    <ul>
        {{-- すべての投稿を表示 --}}
        @foreach ($posts as $post)
            <li>
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img src="{{ Gravatar::get($post->user->email, ['size' => 50]) }}" alt="">
                <div>
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        <a href="{{asset('users/show/' . $post->user->id, ['user' => $user->id])}}">{{ $post->user->name }}</a>
                    </div>
                    <div>
                        {{-- 投稿の作成日時を表示 --}}
                        {{ $post->created_at }}
                    </div>
                    <div>
                        {{-- 画像をクリックしたら投稿の詳細ページを表示 --}}
                        <a href="#">
                            {{-- 画像 --}}
                            <img src="{{ asset('storage/' . $post->sweets_image) }}" alt="">
                        </a>
                        {{-- スイーツの名前 --}}
                        <div>
                            {{ $post->sweets_name }}
                        </div>
                        {{-- 店の名前 --}}
                        <div>
                            {{ $post->store_name }}
                        </div>
                        {{-- 駅の名前 --}}
                        <div>
                            {{ $post->station }}
                        </div>
                        {{-- コメント --}}
                        <div>
                            {{ $post->comment }}
                        </div>
                    </div>
                    <div>
                        {{-- ログインしているユーザがすでにこの投稿をいいねしているなら --}}
                        @if (Auth::user()->is_favorite($post->id))
                            {{-- いいね解除ボタン --}}
                            <form action="{{asset('/posts/unfavorite/' . $post->id)}}" method="get">
                                @csrf
                                <input type='hidden' name='post_id' value="{{$post->id}}">
                                {{-- submitは後ろに持ってくる --}}
                                <input type="submit" id="unfavorite" value="♥">
                            </form>
                        {{-- まだいいねしていなければ --}}
                        @else
                            {{-- いいねボタン --}}
                            <form action="{{asset('/posts/favorite/' . $post->id)}}" method="get">
                                @csrf
                                <input type='hidden' name='post_id' value="{{$post->id}}">
                                {{-- submitは後ろに持ってくる --}}
                                <input type="submit" id="favorite" value="♡">
                            </form>
                        @endif
                    </div>
                    <div>
                        {{-- ログイン中のidがこの投稿のユーザidと一緒なら --}}
                        @if (Auth::id() == $post->user_id)
                            {{-- 投稿削除ボタン --}}
                            <form action="{{asset('/posts/destroy/'.$post->id)}}" method="get">
                                @csrf
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                {{-- submitは後ろに持ってくる --}}
                                <input type="submit" id="delete" value="削除">
                            </form>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endif