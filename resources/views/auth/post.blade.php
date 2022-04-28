@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>投稿</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('image', 'スイーツの写真') !!}
                    {!! Form::file('image', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('sweets_name', 'スイーツの名前') !!}
                    {!! Form::text('sweets_name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('store_name', 'お店の名前') !!}
                    {!! Form::text('store_name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('station', '最寄り駅') !!}
                    {!! Form::text('station', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('comment', 'コメント') !!}
                    {!! Form::text('comment', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}

        </div>
    </div>
@endsection