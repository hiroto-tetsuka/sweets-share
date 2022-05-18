<ul class="postIndex">
    {{-- すべての投稿を表示 --}}
    @foreach ($posts as $post)
        <a href="{{asset('/users/show/' . $post->user->id)}}">
            <li class="postShow">
                <div class="cardTop">
                    
                    @if($post->user->user_icon == null)
                        <div class="iconImg">
                            {{-- ユーザアイコン --}}
                            <img src="{{asset('storage/default_icon.png')}}" alt="">
                        </div>
                    @else
                        <div class="iconImg">
                            {{-- デフォルトユーザアイコン --}}
                            <img src="{{Storage::url('/user_icon/' . $post->user->user_icon)}}" alt="">
                        </div>
                    @endif
                    
                    <div class="cardTopFlex">
                        <div>
                            {{-- 投稿の所有者の名前 --}}
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
                    <a href="{{asset('posts/show/' . $post->id)}}">
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
                            <button class="unfavorite_button" value="{{$post->id}}" id="unfavorite">♥</button>
                        {{-- まだいいねしていなければ --}}
                        @else
                            {{-- いいねボタン --}}
                            <button class="favorite_button" value="{{$post->id}}" id="favorite">♡</button>
                        @endif
                    </div>
                    <div>
                        {{-- ログイン中のidがこの投稿のユーザidと一緒なら --}}
                        @if (Auth::id() == $post->user_id)
                            {{-- 投稿削除ボタン --}}
                            <button class="delete_button" value="{{$post->id}}" id="delete">削除</button>
                        @endif
                    </div>
                </div>
            </li>
        </a>
    @endforeach
    
    <form class="delete_form" action="{{asset('/posts/destroy')}}" method="POST">
        @csrf
        <input type="hidden" id="delete_id" name="post_id" value="">
    </form>
    
    <form class="favorite_form" action="{{asset('/posts/favorite')}}" method="POST">
        @csrf
        <input type="hidden" id="favorite_id" name="post_id" value="">
    </form>
    
    <form class="unfavorite_form" action="/posts/unfavorite" method="POST">
        @csrf
        <input type="hidden" id="unfavorite_id" name="post_id" value="">
    </form>
</ul>