@extends('layouts.app')

@section('content')
    <div>
        <h1>投稿</h1>
    </div>
    <div>
        <div>
            <form action="{{asset('posts/store/{id}')}}" enctype='multipart/form-data' method="post">
                @csrf
                <div>
                    {!! Form::label('sweets_image', 'スイーツの写真') !!}
                    <input type="file" id="sweets_image" name="sweets_image">
                </div>
                
                <input type="hidden" value={{ \Auth::id() }} name="user_id">
               
                <div>
                    {!! Form::label('sweets_name', 'スイーツの名前') !!}
                    {!! Form::text('sweets_name', null, ['class' => 'form-control']) !!}
                </div>

                <div>
                    {!! Form::label('store_name', 'お店の名前') !!}
                    {!! Form::text('store_name', null, ['class' => 'form-control']) !!}
                </div>

                <div>
                    {!! Form::label('station', '最寄り駅') !!}
                    {!! Form::text('station', null, ['class' => 'form-control']) !!}
                </div>

                <div>
                    {!! Form::label('comment', 'コメント') !!}
                    {!! Form::text('comment', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-block']) !!}
            </form>
        </div>
    </div>
@endsection