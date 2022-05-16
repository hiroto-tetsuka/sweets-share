@extends('layouts.app')

@section('content')
    {{-- ログインが確認できたときのトップページ --}}
    @if(Auth::check())
        <div class="loginTopPage">
            {{-- 投稿一覧 --}}
            @include('posts.posts')
        </div>
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