@extends('layouts.app')

@section('content')
    <div>
        {{-- ユーザ情報 --}}
        @include('users.card')
        <div>
            {{-- タブ --}}
            @include('users.navtabs')
            {{-- ユーザ一覧 --}}
            @include('users.users')
        </div>
    </div>
@endsection