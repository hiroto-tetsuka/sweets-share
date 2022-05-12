<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    // フォローするアクション
    public function store($id)
    {
        // ログインしているユーザがidのユーザをフォローする
        \Auth::user()->follow($id);
        
        // 前のURLへリダイレクトされる
        return back();
    }
    
    // アンフォローするアクション
    public function destroy($id)
    {
        // ログインしているユーザがidのユーザをアンフォローする
        \Auth::user()->unfollow($id);
        
        // 前のURLへリダイレクトされる
        return back();
    }
}
