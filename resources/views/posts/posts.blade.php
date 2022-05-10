@if (count($posts) > 0)
    <ul class="list-unstyled">
        @foreach ($posts as $post)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($post->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $post->user->name, ['user' => $post->user->id]) !!}
                    </div>
                    <div>
                        <span class="text-muted">{{ $post->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        {{-- 画像をクリックしたら投稿の詳細ページを表示 --}}
                        <a href="#"><img src="{{ asset('storage/' . $post->sweets_image) }}" alt=""></a>
                        <p class="mb-0">{!! nl2br(e($post->sweets_name)) !!}</p>
                        <p class="mb-0">{!! nl2br(e($post->store_name)) !!}</p>
                        <p class="mb-0">{!! nl2br(e($post->station)) !!}</p>
                        <p class="mb-0">{!! nl2br(e($post->comment)) !!}</p>
                    </div>
                    <div>
                        @if (Auth::user()->is_favorite($post->id))
                            {{-- いいね解除ボタン --}}
                            {!! Form::open(['route' => ['favorites.unfavorite', $post->id], 'method' => 'delete']) !!}
                                {!! Form::submit('❤', ['class' => 'btn btn-warning btn-sm']) !!}
                                <input type='hidden' name='post_id' value="{{$post->id}}">
                            {!! Form::close() !!}
                        @else
                            {{-- いいねボタン --}}
                            {!! Form::open(['route' => ['favorites.favorite', $post->id], 'method' => 'post']) !!}
                                {!! Form::submit('♡', ['class' => 'btn btn-success btn-sm']) !!}
                                <input type='hidden' name='post_id' value="{{$post->id}}">
                            {!! Form::close() !!}
                        @endif
                    </div>
                    <div>
                        @if (Auth::id() == $post->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endif