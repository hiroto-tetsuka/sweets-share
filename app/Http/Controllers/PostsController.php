<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザとフォロワーの投稿の一覧を作成日時の降順で取得
            $posts = $user->feed_posts()->orderBy('created_at', 'desc')->paginate(10);
            $data = [];
            $data = [
                'user' => $user,
                'posts' => $posts,
            ];
            // Welcomeビューでそれらを表示
            return view('welcome', $data); 
        }else{
            $posts = Post::orderBy('created_at', 'desc')->paginate(10);
            return view('welcome')->with('posts', $posts);
        }
    }
    
    public function create()
    {
        $post = new Post;
        
        return view('posts.create' , [
            'post' => $post
        ]);
    }
    
    public function store(Request $request)
    {
        // 画像を保存
        $file_name = $request->sweets_image->store('public');
        // 画像を取得
        // URLの最後の/以降の名前だけ取得
        $after_remove_file_name = Str::afterLast($file_name, '/');
        
        $request->validate([
            'sweets_image' => 'required',
            'sweets_name' => 'required|max:20',
            'store_name' => 'required|max:20',
            'station' => 'required|max:20',
            'comment' => 'required|max:40',
        ]);
        
        $post = new Post;
        $post->sweets_image = $after_remove_file_name;
        $post->user_id = $request->user_id;
        $post->sweets_name = $request->sweets_name;
        $post->store_name = $request->store_name;
        $post->station = $request->station;
        $post->comment = $request->comment;
        $post->save();
        
        $user = \Auth::user();
        $posts = $user->feed_posts()->orderBy('created_at', 'desc')->paginate(10);
        
        // 投稿一覧を表示するページに変数を渡す
        return view('welcome')
        // $file_nameをsweets_imageに格納し、welcomeファイルで使えるようにする
        ->with('sweets_image', $after_remove_file_name)
        // $postsをpostsに格納し、welcomeファイルで使えるようにする
        ->with('posts',  $posts);
    }
    
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $post = \App\Post::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $post->user_id) {
            $post->delete();
        }
        // 子のcontroller内のindexメソッドにリダイレクトさせる
        return self::index();
    }
}
