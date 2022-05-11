@extends('layouts.app')

@section('content')
<div>
    <div>
        <h1>新規登録</h1>
    </div>
    <div>
        <div>
            <form action="{{asset('/signup')}}" method="post">
                @csrf
                <div>
                    <p>ユーザ名<input type="text" id="name" name="name"></p>
                </div>
                <div>
                    <p>メールアドレス<input type="email" id="email" name="email" placeholder="sample@mail.com"></p>
                </div>
                <div>
                    <p>パスワード<input type="password" id="password" name="password" placeholder="8文字以上"></p>
                </div>
                <div>
                    <p>パスワード(確認)<input type="password" id="password_confirmation" name="password_confirmation"></p>
                </div>
                <input type="submit" id="submit" name="submit" value="登録">
            </form>
            <p>すでに登録している方は<a href="{{asset('login')}}">こちら</a></p>
        </div>
    </div>
</div>
@endsection