@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>投稿</h1>
    </div>
    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            <form method="POST" action="{{route('posts.store', $post)}}" enctype='multipart/form-data'>
                @csrf
                <div class="form-group">
                    {!! Form::label('sweets_image', 'スイーツの写真') !!}
                    <input type="file" id="sweets_image" name="sweets_image" class="form-control">
                </div>
                
                <input type="hidden" value={{ \Auth::id() }} name="user_id">
               
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
            </form>
        </div>
    </div>
@endsection