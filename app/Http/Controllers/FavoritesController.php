<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    // いいねした投稿を登録
    public function store(Request $request)
    {
        // いいねした投稿のidを取得
        $post_id = $request->post_id;
        // すべてのユーザからログイン中のユーザを取得
        $userModel = \Auth::user();
        // ログイン中のユーザのidを取得
        $user_id = $userModel->id;
        // ログイン中のユーザでいいねを実行
        $userModel->favorite($user_id, $post_id);
        
        // return back();
        return view('welcome');
    }
    
    // いいねした投稿を削除
    public function delete(Request $request)
    {
        // いいねした投稿のidを取得
        $post_id = $request->post_id;
        // すべてのユーザからログイン中のユーザを取得
        $userModel = \Auth::user();
        // ログイン中のユーザのidを取得
        $user_id = $userModel->id;
        // ログイン中のユーザでいいねを解除
        $userModel->unfavorite($user_id, $post_id);
        
        // return back();
        return view('welcome');
    }
}
