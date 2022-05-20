@extends('layouts.app')

@section('content')
    
    <div>
        
        {{-- ユーザ情報 --}}
        @include('users.card')
        
        <div>
            
            {{-- タブ --}}
            @include('users.navtabs')
            
            @if(count($posts) > 0)
                
                {{-- ユーザ一覧 --}}
                @include('posts.posts')
                
            @else
                
                <div class="showUserMessage">投稿のハートを押してみましょう！</div>
                
            @endif
            
        </div>
    </div>
    
@endsection