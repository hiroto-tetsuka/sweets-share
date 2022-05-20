@extends('layouts.app')

@section('content')
    
    <div>
        <aside class="col-sm-4">
            
            {{-- ユーザ情報 --}}
            @include('users.card')
            
        </aside>
        <div>
            
            {{-- タブ --}}
            @include('users.navtabs')
            
            @if(count($users) > 0)
                
                {{-- ユーザ一覧 --}}
                @include('users.users')
                
            @else
                
                <div class="showUserMessage">フォローされるような投稿をしましょう！</div>
                
            @endif
            
        </div>
    </div>
    
@endsection