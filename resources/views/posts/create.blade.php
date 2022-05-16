@extends('layouts.app')

@section('content')
<div class="entrance">
    <div class="pageTitle">
        <h2>投稿</h2>
    </div>
    <div>
        {{-- 投稿フォーム --}}
        <form action="{{asset('/posts/store')}}" enctype='multipart/form-data' method="post">
            @csrf
            
            {{-- ログインしているユーザのidをhiddenで送る --}}
            <input type="hidden" name="user_id" value={{ \Auth::id() }}>
            
            <div class="signItem"><div class="signItemLeft">スイーツの写真</div>
                <input type="file" id="sweets_image" name="sweets_image" class="signItemRight">
            </div>
           
            <div class="signItem"><div class="signItemLeft">スイーツの名前</div>
                <input type="text" id="sweets_name" name="sweets_name" placeholder="20文字以内" class="signItemRight">
            </div>
            
            <div class="signItem"><div class="signItemLeft">お店の名前</div>
                <input type="text" id="store_name" name="store_name" placeholder="20文字以内" class="signItemRight">
            </div>
            
            <div class="signItem"><div class="signItemLeft">最寄り駅</div>
                <input type="text" id="station" name="station" placeholder="〇〇駅" class="signItemRight">
            </div>
            
            <div class="signItem"><div class="signItemLeft">コメント</div>
                <input type="text" id="comment" name="comment" placeholder="40文字以内" class="signItemRight">
            </div>
            
            <input type="submit" id="create_post" value="投稿" class="btn">
        </form>
    </div>
</div>
@endsection