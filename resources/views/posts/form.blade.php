{!! Form::open(['route' => 'posts.store']) !!}
    <div class="form-group">
        {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '2']) !!}
        {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
{!! Form::close() !!}