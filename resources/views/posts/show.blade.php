@extends('layouts.app')

@section('content')
<div class="showPostFlex">
    <div class="showPostImg">
        <img src="{{ asset('storage/' . $post->sweets_image) }}" alt="">
        
        {{-- ログインしているユーザがすでにこの投稿をいいねしているなら --}}
        @if (Auth::user()->is_favorite($post->id))
        
            {{-- いいね解除ボタン --}}
            <div class="showPostFavorite">
                <button class="unfavorite_button" value="{{$post->id}}" id="unfavorite">♥</button>
            </div>
            
        {{-- まだいいねしていなければ --}}
        @else
            
            {{-- いいねボタン --}}
            <div class="showPostFavorite">
                <button class="favorite_button" value="{{$post->id}}" id="favorite">♡</button>
            </div>
            
        @endif
    </div>
    
    <div class="showPostFlexRight">
        <div class="showPostPosts">
            <div>スイーツの名前：
                {{$post->sweets_name}}
            </div>
            
            <div>お店の名前：
                {{$post->store_name}}
            </div>
            
            <div>最寄り駅：
                {{$post->station}}
            </div>
            
            <div>コメント：
                {{$post->comment}}
            </div>
        </div>
        
        <div class="userIconNameFollow">
            <div class="showPostUserIcon">
                <a href="{{asset('/users/show/' . $post->user->id)}}">
                    @if($post->user->user_icon == null)
                        <div class="showPostIcon">
                            {{-- ユーザアイコン --}}
                            <img src="{{asset('storage/default_icon.png')}}" alt="">
                        </div>
                    @else
                        <div class="showPostIcon">
                            {{-- デフォルトユーザアイコン --}}
                            <img src="{{Storage::url('/user_icon/' . $post->user->user_icon)}}" alt="">
                        </div>
                    @endif
                </a>
            </div>
            
            <div class="showPostUserName">
                {{$post->user->name}}
            </div>
            
            <div class="showPostFollow">
                {{-- フォロー/アンフォロー --}}
                {{-- ログインしているidがそのユーザのidと等しくなければ --}}
                @if(Auth::id() != $post->user->id)
                
                    {{-- ログインしているユーザがすでにフォローしていれば --}}
                    @if(Auth::user()->is_following($post->user->id))
                    
                        {{-- アンフォローボタンを表示 --}}
                        <div class="showPostFollowButton">
                        <button class="unfollow_button" value="{{$post->user->id}}" id="unfollow">アンフォロー</button>
                        </div>
                    {{-- ログインしているユーザがまだフォローしていなければ --}}
                    @else
                    
                        {{-- フォローボタンを表示 --}}
                        {{-- アンフォローボタンを表示 --}}
                        <div class="showPostFollowButton">
                        <button class="follow_button" value="{{$post->user->id}}" id="follow">フォロー</button>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
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