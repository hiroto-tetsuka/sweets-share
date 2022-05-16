@extends('layouts.app')

@section('content')
    <div>
        {{-- ユーザ情報 --}}
        @include('users.card')
        {{-- タブ --}}
        @include('users.navtabs')
        {{-- 投稿一覧 --}}
        @include('posts.posts')
    </div>
@endsection