<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $posts = $user->feed_posts()->orderBy('created_at', 'desc')->get();

            $data = [
                'user' => $user,
                'posts' => $posts,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('welcome', $data);
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
        // 画像を取得
        $file_name = $request->sweets_image->getClientOriginalName();
        
        // 画像を保存
        $request->sweets_image->storeAs('public', $file_name);
        
        $request->validate([
            'sweets_image' => 'required',
            'sweets_name' => 'required|max:20',
            'store_name' => 'required|max:20',
            'station' => 'required|max:20',
            'comment' => 'required|max:40',
        ]);
        
        $post = new Post;
        $post->sweets_image = $file_name;
        $post->user_id = $request->user_id;
        $post->sweets_name = $request->sweets_name;
        $post->store_name = $request->store_name;
        $post->station = $request->station;
        $post->comment = $request->comment;
        $post->save();
        
        $user = \Auth::user();
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
        
        // 投稿一覧を表示するページに変数を渡す
        return view('welcome')
        // $file_nameをsweets_imageに格納し、posts.postsファイルで使えるようにする
        ->with('sweets_image', $file_name)
        // $postsをpostsに格納し、posts.postsファイルで使えるようにする
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

        // 前のURLへリダイレクトさせる
        return back();
    }
}