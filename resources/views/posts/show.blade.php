@extends('layouts.app')

@section('content')
    
    <div>
        <img src="{{ asset('storage/' . $post->sweets_image) }}" alt="">
    </div>
    
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
        {{$post->sweets_name}}
    </div>
    
    <div>
        {{$post->store_name}}
    </div>
    
    <div>
        {{$post->station}}
    </div>
    
    <div>
        {{$post->comment}}
    </div>
    
    <div>
        <a href="{{asset('/users/show/' . $post->user->id)}}">
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
        </a>
    </div>
    
    <div>
        {{$post->user->name}}
    </div>
    
    <div>
        {{-- フォロー/アンフォロー --}}
        {{-- ログインしているidがそのユーザのidと等しくなければ --}}
        @if(Auth::id() != $post->user->id)
        
            {{-- ログインしているユーザがすでにフォローしていれば --}}
            @if(Auth::user()->is_following($post->user->id))
            
                {{-- アンフォローボタンを表示 --}}
                <button class="unfollow_button" value="{{$post->user->id}}" id="unfollow">アンフォロー</button>
                
            {{-- ログインしているユーザがまだフォローしていなければ --}}
            @else
            
                {{-- フォローボタンを表示 --}}
                <button class="follow_button" value="{{$post->user->id}}" id="follow">フォロー</button>
                
            @endif
        @endif
    </div>
@endsection

{{-- いいね --}}
<form class="favorite_form" action="{{asset('/posts/favorite')}}" method="POST">
    @csrf
    <input type="hidden" id="favorite_id" name="post_id" value="">
</form>

{{-- いいね解除 --}}
<form class="unfavorite_form" action="/posts/unfavorite" method="POST">
    @csrf
    <input type="hidden" id="unfavorite_id" name="post_id" value="">
</form>

{{-- フォロー --}}
<form class="follow_form" action="{{asset('/users/' . $post->user->id . '/follow')}}" method="POST">
    @csrf
    <input type="hidden" id="follow_id" name="user_id" value="">
</form>

{{-- アンフォロー --}}
<form class="unfollow_form" action="{{asset('/users/' . $post->user->id . '/unfollow')}}" method="POST">
    @csrf
    <input type="hidden" id="unfollow_id" name="user_id" value="">
</form>