@extends('layouts.app')

@section('content')
<div class="entrance">
    <div class="pageTitle">
        <h2>ログイン</h2>
    </div>
    <div>
        <form action="{{asset('/login')}}" method="post">
            @csrf
            
            <div class="signItem"><div class="signItemLeft">メールアドレス</div>
                <input type="email" id="email" name="email" placeholder="sample@mail.com" class="signItemRight">
            </div>
            
            <div class="signItem"><div class="signItemLeft">パスワード</div>
                <input type="password" id="password" name="password" placeholder="8文字以上" class="signItemRight">
            </div>
            
            <input type="submit" id="login" value="ログイン" class="btn">
        </form>
        {{-- 新規登録ページへのリンク --}}
        登録がまだの方は<a href="{{asset('/signup')}}">こちら</a>
    </div>
</div>
@endsection