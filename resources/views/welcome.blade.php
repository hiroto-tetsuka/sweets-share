@extends('layouts.app')

@section('content')
    @if(Auth::check())
        ようこそ、{{Auth::user()->name}}さん！
        {{-- ログアウトへのリンク --}}
        {!! link_to_route('logout.get', 'Logout') !!}
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h3>気に入ったスイーツをシェアしよう！</h3>
            </div>
        </div>
    @endif
@endsection