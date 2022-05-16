<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    // いいねした投稿を登録するアクション
    public function store(Request $request)
    {
        // いいねした投稿のidを取得
        $post_id = $request->post_id;
        
        // ログイン中のユーザを取得
        $userModel = \Auth::user();
        
        // ログイン中のユーザのidを取得
        $user_id = $userModel->id;
        
        // ログイン中のユーザでいいねを実行
        $userModel->favorite($user_id, $post_id);
        
        // 自分とフォローしている人の投稿を取得
        $posts = $userModel->feed_posts()->orderBy('created_at', 'desc')->get();
        
        // ビューに投稿のデータを送る
        return view('welcome')
        
        // $postsをpostsとしてwelcomeビューで使用できるようにする
        ->with('posts', $posts);
    }
    
    // いいねした投稿を削除するアクション
    public function delete(Request $request)
    {
        // いいねした投稿のidを取得
        $post_id = $request->post_id;
        
        // ログイン中のユーザを取得
        $userModel = \Auth::user();
        
        // ログイン中のユーザのidを取得
        $user_id = $userModel->id;
        
        // ログイン中のユーザでいいねを解除
        $userModel->unfavorite($user_id, $post_id);
        
        // 自分とフォローしている人の投稿を取得
        $posts = $userModel->feed_posts()->orderBy('created_at', 'desc')->get();
        
        // ビューに投稿のデータを送る
        return view('welcome')
        
        // $postsをpostsとしてwelcomeビューで使用できるようにする
        ->with('posts', $posts);
    }
}
