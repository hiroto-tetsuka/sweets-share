{{-- 投稿が1つ以上あれば --}}
@if (count($posts) > 0)
    <ul class="postIndex">
        {{-- すべての投稿を表示 --}}
        @foreach ($posts as $post)
            <a href="{{asset('users/show/' . $post->user->id)}}">
                <li class="postShow">
                    <div class="cardTop">
                        <div class="iconImg">
                            {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                            <img src="{{ Gravatar::get($post->user->email, ['size' => 50]) }}" alt="">
                        </div>
                        <div class="cardTopFlex">
                            <div>
                                {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                {{ $post->user->name }}
                            </div>
                            <div>
                                {{-- 投稿の作成日時を表示 --}}
                                {{ $post->created_at }}
                            </div>
                        </div>
                    </div>
                    <div class="postImg">
                        {{-- 画像をクリックしたら投稿の詳細ページを表示 --}}
                        <a href="{{asset('users/show/' . $post->user->id)}}">
                            {{-- 画像 --}}
                            <img src="{{ asset('storage/' . $post->sweets_image) }}" alt="">
                        </a>
                    </div>
                    {{-- スイーツの名前 --}}
                    <div class="cardItem">
                        {{ $post->sweets_name }}
                    </div>
                    {{-- 店の名前 --}}
                    <div class="cardItem">
                        {{ $post->store_name }}
                    </div>
                    {{-- 駅の名前 --}}
                    <div class="cardItem">
                        {{ $post->station }}
                    </div>
                    {{-- コメント --}}
                    <div class="cardItem">
                        {{ $post->comment }}
                    </div>
                    <div class="cardButton">
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
            </a>
        @endforeach
    </ul>
@endif