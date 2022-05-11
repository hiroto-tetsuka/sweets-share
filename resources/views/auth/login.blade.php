@extends('layouts.app')

@section('content')
<div>
    <div>
        <h1>ログイン</h1>
    </div>
    <div>
        <div>
            <form action="{{asset('login')}}" method="post">
                @csrf
                <div>
                    <p>メールアドレス<input type="email" id="email" name="email" placeholder="sample@mail.com"></p>
                </div>
                <div>
                    <p>パスワード<input type="password" id="password" name="password" placeholder="8文字以上"></p>
                </div>
                <input type="submit" id="submit" name="submit" value="ログイン">
            </form>
            {{-- 新規登録ページへのリンク --}}
            <p>登録がまだの方は<a href="{{asset('signup')}}">こちら</a></p>
        </div>
    </div>
</div>
@endsection