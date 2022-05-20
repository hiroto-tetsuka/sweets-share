<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use App\User;

class PostsController extends Controller
{
    // 投稿一覧を表示するアクション
    public function index(Request $request)
    {
        if($request->topAllFollow == "ALL"){
            // PostモデルのgetUsersInfo関数を呼び出す
            $posts = Post::getUsersInfo();
            
            // ビューに$postsを送る
            return view('welcome')
            ->with('posts', $posts);
            
        }elseif($request->topAllFollow == "FOLLOW"){
            
            if (\Auth::check()) {
                
                // ログインしているユーザを取得
                $user = \Auth::user();
                
                // postsテーブルにusersテーブルをjoinする。postsテーブルのuser_idとusersテーブルのidを基準に繋げる。
                // これ以上簡単に書く方法はない。
                $post_user_icon = \DB::table('posts')->join('users', 'posts.user_id', '=', 'users.id')->get();
                
                // ユーザとフォロワーの投稿を作成日時の降順で取得
                $posts = $user->feed_posts()->orderBy('created_at', 'desc')->get();
                
                // 空配列を用意
                $data = [];
                
                // ユーザと投稿を配列に格納
                $data = [
                    'user' => $user,
                    'post_user_icon' => $post_user_icon,
                    'posts' => $posts,
                ];
                
                // Welcomeビューでそれらを表示
                return view('welcome', $data); 
                
            // ログインが確認できなければ
            }
            
        }else{
            // PostモデルのgetUsersInfo関数を呼び出す
            $posts = Post::getUsersInfo();
            
            // ビューに$postsを送る
            return view('welcome')
            ->with('posts', $posts);
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
        // 調整
        $request->validate([
            'sweets_image' => 'required',
            'sweets_name' => 'required|max:20',
            'store_name' => 'required|max:20',
            'station' => 'required|max:20',
            'comment' => 'required|max:40',
        ]);
        
        // publicフォルダから画像を保存
        $file_name = $request->sweets_image->store('public');
        
        // 画像を取得
        // URLの末尾の/以降の名前だけを取得
        $after_remove_file_name = Str::afterLast($file_name, '/');
        
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
        $posts = $user->feed_posts()->orderBy('created_at', 'desc')->get();
        
        // URLを指定してリダイレクトする
        return redirect('/');
        
        // 投稿一覧を表示するページに変数を渡す
        // return view('welcome')
        // ->with('sweets_image', $after_remove_file_name)
        // ->with('posts', $posts);
    }
    
    // 投稿を削除するアクション
    public function destroy(Request $request)
    {
        // 投稿のidを取得
        $id = $request->post_id;
        
        // idの値で投稿を検索して取得
        $post = \App\Post::findOrFail($id);
        
        // ログインしているユーザがその投稿のユーザであれば
        if (\Auth::id() === $post->user_id) {
            // 投稿を削除
            $post->delete();
        }
        
        // 元のページにリダイレクトする
        // return back();
        return redirect()->back();
    }
    public function showEdit()
    {
        // get
        return view('users.edit');
    }
    
    public function edit(Request $request)
    {
        // バリデーション
        $request->validate([
            'file_path' => 'required',
        ]);
        
        // 画像ファイルを保存
        $file_name = $request->file_path->store('public/user_icon');
        
        // 画像を取得
        $after_remove_file_name = Str::afterLast($file_name, '/');
        
        // ユーザモデルからログイン中のidと一致するものをアップデート
        User::where('id', \Auth::id())->update([
            'user_icon' => $after_remove_file_name
        ]);
        
        // ログイン中のユーザを取得
        $user = User::findUserInfo(\Auth::id());
        
        // ユーザの投稿を取得
        $posts = $user->feed_posts()->orderBy('created_at', 'desc')->get();
        
        // URLを指定してリダイレクトする
        return redirect('/users/show/'.\Auth::id());
        
        // リダイレクト
        // return view('users.show')
        // ->with('posts', $posts)
        // ->with('user', $user);
    }
    
    public function showPost($id)
    {
        $user = \Auth::user();
        
        $post = Post::findOrFail($id);
        
        return view('posts.show')
        ->with('post', $post)
        ->with('user', $user);
    }
}