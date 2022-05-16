@extends('layouts.app')

@section('content')
<div class="entrance">
    <div class="pageTitle">
        <h2>新規登録</h2>
    </div>
    <div>
        <form action="{{asset('/signup')}}" method="post">
            @csrf
            
            <div class="signItem"><div class="signItemLeft">ユーザ名</div>
                <input type="text" id="name" name="name" class="signItemRight">
            </div>
            
            <div class="signItem"><div class="signItemLeft">メールアドレス</div>
                <input type="email" id="email" name="email" placeholder="sample@mail.com" class="signItemRight">
            </div>
            
            <div class="signItem"><div class="signItemLeft">パスワード</div>
                <input type="password" id="password" name="password" placeholder="8文字以上" class="signItemRight">
            </div>
            
            <div class="signItem"><div class="signItemLeft">パスワード(確認)</div>
                <input type="password" id="password_confirmation" name="password_confirmation" class="signItemRight">
            </div>
            
            <input type="submit" id="register" value="登　録" class="btn">
        </form>
        {{-- ログインページへのリンク --}}
        すでに登録している方は<a href="{{asset('/login')}}">こちら</a>
    </div>
</div>
@endsection