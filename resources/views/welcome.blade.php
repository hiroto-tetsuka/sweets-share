@extends('layouts.app')

@section('content')
    {{-- ログインが確認できたときのトップページ --}}
    @if(Auth::check())
        <div>
            <div>
                <div>
                    {{-- ログインしたユーザのユーザ名 --}}
                    <h3>{{ Auth::user()->name }}</h3>
                </div>
                <div>
                    {{-- ログインしたユーザのアイコン --}}
                    <img src="{{asset('storage/sample.jpeg')}}" alt="">
                </div>
            </div>
            <div>
                {{-- 投稿一覧 --}}
                @include('posts.posts')
            </div>
        </div>
    {{-- ログインが確認できなかったときのトップページ --}}
    @else
        <div>
            <h4>お気に入りのスイーツをシェアしよう！</h4>
        </div>
        <div>
            {{-- すべての投稿の画像だけを一覧で表示 --}}
            @foreach($posts as $post)
                {{-- 画像をクリックしたら新規登録画面を表示 --}}
                <a href="{{asset('login')}}"><img src="{{ asset('storage/' . $post->sweets_image) }}" alt=""></a>
            @endforeach
        </div>
    @endif
@endsection