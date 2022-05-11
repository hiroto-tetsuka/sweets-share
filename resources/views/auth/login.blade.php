@extends('layouts.app')

@section('content')
<div>
    <div>
        <h1>ログイン</h1>
    </div>
    <div>
        <div>
            {!! Form::open(['route' => 'login.post']) !!}
                <div>
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
                <div>
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
            {{-- ユーザ登録ページへのリンク --}}
            <p>登録がまだの方は {!! link_to_route('signup.get', '新規登録') !!}</p>
        </div>
    </div>
</div>
@endsection