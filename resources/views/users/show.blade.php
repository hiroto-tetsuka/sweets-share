@extends('layouts.app')

@section('content')
    <div class="row">
            @include('users.card')
        <div class="col-sm-8">
            {{-- タブ --}}
            @include('users.navtabs')
            {{-- 投稿一覧 --}}
            @include('posts.posts')
        </div>
    </div>
@endsection