<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    // フォローするアクション
    public function store($id)
    {
        // 認証済みユーザがidのユーザをフォローする
        \Auth::user()->follow($id);
        // 前のURLへリダイレクトされる
        return back();
    }
    
    // アンフォローするアクション
    public function destroy($id)
    {
        // 認証済みユーザがidのユーザをアンフォローする
        \Auth::user()->unfollow($id);
        // 前のURLへリダイレクトされる
        return back();
    }
}
