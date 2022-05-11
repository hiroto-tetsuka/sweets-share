@if (count($posts) > 0)
    <ul>
        @foreach ($posts as $post)
            <li>
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img src="{{ Gravatar::get($post->user->email, ['size' => 50]) }}" alt="">
                <div>
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        <a href="{{asset('users/show/' . Auth::id())}}">{{ $post->user->name }}</a>
                    </div>
                    <div>
                        <span>{{ $post->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        {{-- 画像をクリックしたら投稿の詳細ページを表示 --}}
                        <a href="#"><img src="{{ asset('storage/' . $post->sweets_image) }}" alt=""></a>
                        <p>{!! nl2br(e($post->sweets_name)) !!}</p>
                        <p>{!! nl2br(e($post->store_name)) !!}</p>
                        <p>{!! nl2br(e($post->station)) !!}</p>
                        <p>{!! nl2br(e($post->comment)) !!}</p>
                    </div>
                    <div>
                        @if (Auth::user()->is_favorite($post->id))
                            {{-- いいね解除ボタン --}}
                            <form action="{{url('/posts/'.$post->id.'/unfavorite')}}" method="post">
                                @csrf
                                <input type='hidden' name='post_id' value="{{$post->id}}">
                                <input type="submit" id="unfavorite" value="♥">
                            </form>
                        @else
                            {{-- いいねボタン --}}
                            <form action="{{url('/posts/'.$post->id.'/favorite')}}" method="post">
                                @csrf
                                <input type='hidden' name='post_id' value="{{$post->id}}">
                                <input type="submit" id="favorite" value="♡">
                            </form>
                        @endif
                    </div>
                    <div>
                        {{-- ログイン中のidが投稿を所持しているユーザのidと一緒なら --}}
                        @if (Auth::id() == $post->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            <form action="{{asset('posts/destroy/' . $post->id)}}" method="post">
                                @csrf
                                <input type="submit" id="delete" name="delete" value="削除">
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                            </form>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endif