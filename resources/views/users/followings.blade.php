@extends('layouts.app')

@section('content')
    
    <div>
        
        {{-- ユーザ情報 --}}
        @include('users.card')
        
        <div>
            
            {{-- タブ --}}
            @include('users.navtabs')
            
            @if(count($users) > 0)
                
                {{-- ユーザ一覧 --}}
                @include('users.users')
                
            @else
                
                <div class="showUserMessage">他のアカウントをフォローしてみましょう！</div>
                
            @endif
            
        </div>
    </div>
    
@endsection