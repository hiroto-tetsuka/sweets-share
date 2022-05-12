@extends('layouts.app')

@section('content')
    <div>
        {{-- ユーザ情報 --}}
        @include('users.card')
        <div>
            {{-- タブ --}}
            @include('users.navtabs')
            {{-- 投稿一覧 --}}
            @include('posts.posts')
        </div>
    </div>
@endsection