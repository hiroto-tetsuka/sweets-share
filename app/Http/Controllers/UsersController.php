<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    // ユーザ一覧を表示するアクション
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->get();

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    // ユーザ詳細を表示するアクション
    public function show($id)
    {
        // idを引数としてUserモデルのfindUserInfo関数を呼び出し、ユーザ情報を取得する
        $user = User::findUserInfo($id);
        
        // ユーザの投稿一覧を作成日時の降順で取得
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        
        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
    
    // フォロー一覧を表示するアクション
    public function followings($id)
    {
        // idで検索してユーザを取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザのフォロー一覧を取得;
        $followings = $user->followings()->get();
        
        // フォロー一覧をビューで表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }
    
    // フォロワー一覧を表示するアクション
    public function followers($id)
    {
        // idで検索してユーザを取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->get();
        
        // フォロワー一覧をビューで表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    // いいね一覧を取得してビューに渡す
    public function favorites($id)
    {
        // 空配列を用意
        $user = [];
        
        // idが一致するユーザを取得
        $user = User::findOrFail($id);
        
        // ユーザの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザのいいね一覧を取得
        $posts = $user->feed_favorites()->get();
        
        // いいね一覧をビューで表示
        return view('users.favorites', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
}
