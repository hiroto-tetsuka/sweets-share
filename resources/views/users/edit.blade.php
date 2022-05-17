@extends('layouts.app')

@section('content')
<form method="post" action="{{url('/edit')}}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file_path">
    <input type="submit" value="アップロード">
</form>
@endsection