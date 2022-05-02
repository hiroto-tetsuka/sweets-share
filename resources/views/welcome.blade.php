@extends('layouts.app')

@section('content')
    @if(Auth::check())
        ようこそ、{{Auth::user()->name}}さん！
        {{-- ログアウトへのリンク --}}
        {!! link_to_route('logout.get', 'Logout') !!}
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
        <div class="center jumbotron">
            <div class="text-center">
                <h4>気に入ったスイーツをシェアしよう！</h4>
            </div>
        </div>
    @endif
@endsection