@extends('layouts.app')

@section('content')
<form method="post" action="{{url('/edit')}}" enctype="multipart/form-data">
    @csrf
    <div class="userIconUpload">
        <input type="file" name="file_path">
        <div class="fileUpload">
            <input type="submit" value="アップロード" id="file">
        </div>
    </div>
</form>
@endsection