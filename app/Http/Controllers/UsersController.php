<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->get();

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

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
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
        
        $followers = $user->followers()->get();
        
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
}
