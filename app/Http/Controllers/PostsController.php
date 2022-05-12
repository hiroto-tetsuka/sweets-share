<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    // 投稿一覧を表示するアクション
    public function index()
    {
        // ログインが確認できたら
        if (\Auth::check()) {
            
            // ログインしているユーザを取得
            $user = \Auth::user();
            
            // ユーザとフォロワーの投稿を作成日時の降順で取得
            $posts = $user->feed_posts()->orderBy('created_at', 'desc')->paginate(10);
            
            // 空配列を用意
            $data = [];
            
            // ユーザと投稿を配列に格納
            $data = [
                'user' => $user,
                'posts' => $posts,
            ];
            
            // Welcomeビューでそれらを表示
            return view('welcome', $data); 
            
        // ログインが確認できなければ
        }else{
            // 投稿を作成日時の降順で取得
            $posts = Post::orderBy('created_at', 'desc')->paginate(10);
            
            // ビューに$postsを送る
            return view('welcome')->with('posts', $posts);
        }
    }
    
    // 投稿を作成するアクション
    public function create()
    {
        // Postクラスをインスタンス化
        $post = new Post;
        
        // ビューに送る
        return view('posts.create' , [
            'post' => $post
        ]);
    }
    
    // 投稿をデータベースに登録するアクション
    public function store(Request $request)
    {
        // publicフォルダから画像を保存
        $file_name = $request->sweets_image->store('public');
        
        // 画像を取得
        // URLの末尾の/以降の名前だけを取得
        $after_remove_file_name = Str::afterLast($file_name, '/');
        
        // 調整
        $request->validate([
            'sweets_image' => 'required',
            'sweets_name' => 'required|max:20',
            'store_name' => 'required|max:20',
            'station' => 'required|max:20',
            'comment' => 'required|max:40',
        ]);
        
        // Postクラスをインスタンス化
        $post = new Post;
        
        // 受け取ったデータを変数に格納していく
        $post->sweets_image = $after_remove_file_name;
        $post->user_id = $request->user_id;
        $post->sweets_name = $request->sweets_name;
        $post->store_name = $request->store_name;
        $post->station = $request->station;
        $post->comment = $request->comment;
        
        // 保存
        $post->save();
        
        // ログインしているユーザの情報を取得
        $user = \Auth::user();
        
        // そのユーザとフォローしているユーザの投稿を作成日時の降順で取得
        $posts = $user->feed_posts()->orderBy('created_at', 'desc')->paginate(10);
        
        // 投稿一覧を表示するページに変数を渡す
        return view('welcome')
        
        // $file_nameをsweets_imageに格納し、welcomeファイルで使えるようにする
        ->with('sweets_image', $after_remove_file_name)
        
        // $postsをpostsに格納し、welcomeファイルで使えるようにする
        ->with('posts',  $posts);
    }
    
    // 投稿を削除するアクション
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $post = \App\Post::findOrFail($id);

        // ログインしているユーザがその投稿のユーザであれば
        if (\Auth::id() === $post->user_id) {
            // 投稿を削除
            $post->delete();
        }
        
        // このcontroller内のindexメソッドにリダイレクトさせる
        return self::index();
    }
}
