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
        // 自分とフォローしている人の投稿を取得
        $posts = $userModel->feed_posts()->orderBy('created_at', 'desc')->paginate(10);
        // ビューに投稿のデータを送る
        return view('welcome')
        ->with('posts', $posts);
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
        // 自分とフォローしている人の投稿を取得
        $posts = $userModel->feed_posts()->orderBy('created_at', 'desc')->paginate(10);
        // ビューに投稿を送る
        return view('welcome')
        ->with('posts', $posts);
    }
}
