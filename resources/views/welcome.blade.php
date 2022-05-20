@extends('layouts.app')

@section('content')
    {{-- ログインが確認できたときのトップページ --}}
    @if(Auth::check())
        
        <div class="loginTopButton">
            <form action="{{asset('/')}}" method="GET">
                @csrf
                <input type="submit" name="topAllFollow" value="ALL" class="changeButton allFollowButton allButton">
            </form>
            
            <div class="changeButton">/</div>
            
            <form action="{{asset('/')}}" method="GET">
                @csrf
                <input type="submit" name="topAllFollow" value="FOLLOW" class="changeButton allFollowButton topFollowButton">
            </form>
        </div>
        
        {{-- 投稿が1つ以上あれば --}}
        @if(count($posts) > 0)
        
            <div class="topImg">
                
                {{-- すべての投稿の画像だけを一覧で表示 --}}
                @foreach($posts as $post)
                
                    {{-- 画像をクリックしたら登録詳細画面を表示 --}}
                    <div class="imgIndex">
                        <a href="{{asset('/posts/show/' . $post->id)}}"><img src="{{ asset('storage/' . $post->sweets_image) }}" alt=""></a>
                    </div>
                    
                @endforeach
                
            </div>
            
        {{-- 表示する投稿がなければ --}}
        @else
        
            <div class="topNoPostMessage">
                <div class="topNoPost">ようこそ {{$user->name}} さん！</div>
                <div class="topNoPost">お気に入りのスイーツを共有しましょう！</div>
            </div>
        
        @endif
        
    {{-- ログインが確認できなかったときのトップページ --}}
    @else
    
        <div>
            <div class="topText">
                <h4>～～～お気に入りのスイーツをシェアしよう～～～</h4>
            </div>
            <div class="topImg">
                
                {{-- すべての投稿の画像だけを一覧で表示 --}}
                @foreach($posts as $post)
                
                    {{-- 画像をクリックしたら新規登録画面を表示 --}}
                    <div class="imgIndex">
                        <a href="{{asset('login')}}"><img src="{{ asset('storage/' . $post->sweets_image) }}" alt=""></a>
                    </div>
                    
                @endforeach
                
            </div>
        </div>
        
    @endif
    
@endsection