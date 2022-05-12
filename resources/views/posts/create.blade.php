@extends('layouts.app')

@section('content')
    <div>
        <h1>投稿</h1>
    </div>
    <div>
        <div>
            {{-- 投稿フォーム --}}
            <form action="{{asset('/posts/store')}}" enctype='multipart/form-data' method="post">
                @csrf
                
                {{-- ログインしているユーザのidをhiddenで送る --}}
                <input type="hidden" name="user_id" value={{ \Auth::id() }}>
                
                <div>スイーツの写真
                    <input type="file" id="sweets_image" name="sweets_image">
                </div>
               
                <div>スイーツの名前
                    <input type="text" id="sweets_name" name="sweets_name" placeholder="20文字以内">
                </div>
                
                <div>お店の名前
                    <input type="text" id="store_name" name="store_name" placeholder="20文字以内">
                </div>
                
                <div>最寄り駅
                    <input type="text" id="station" name="station" placeholder="〇〇駅">
                </div>
                
                <div>コメント
                    <input type="text" id="comment" name="comment" placeholder="40文字以内">
                </div>
                
                <input type="submit" id="create_post" value="投稿">
            </form>
        </div>
    </div>
@endsection