@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ Auth::user()->name }}</h3>
                    </div>
                    <div class="card-body">
                        {{-- 認証済みユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                        <img class="rounded img-fluid" src="{{ Gravatar::get(Auth::user()->email, ['size' => 100]) }}" alt="">
                    </div>
                </div>
            </aside>
            <div class="col-sm-8">
                {{-- 投稿一覧 --}}
                @include('posts.posts')
            </div>
        </div>
    @else
        <div class="home-text">
            <h4>お気に入りのスイーツをシェアしよう！</h4>
        </div>
        {{-- 全投稿の画像だけを一覧で表示 --}}
        <div class="before-signup-img">
            @foreach($posts as $post)
                {{-- 画像をクリックしたら新規登録画面を表示 --}}
                <a href="{{route('login')}}"><img src="{{ asset('storage/' . $post->sweets_image) }}" alt="" class="top-img"></a>
            @endforeach
        </div>
    @endif
@endsection