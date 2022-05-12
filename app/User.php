<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
     // このユーザが所有する投稿（Postモデルとの関係を定義）
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    // このユーザがフォロー中のユーザ（Userモデルとの関係を定義）
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    // このユーザをフォロー中のユーザ（Userモデルとの関係を定義）
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    // このユーザに関係するモデルの件数をロードする
    public function loadRelationshipCounts()
    {
        $this->loadCount(['posts', 'followings', 'followers', 'favorites']);
    }
    
    // このユーザがフォローする機能
    public function follow($userId)
    {
        // すでにフォローしているか
        $exist = $this->is_following($userId);
        
        // 自身かどうか
        $its_me = $this->id == $userId;
        
        if($exist || $its_me){
            // フォロー済み、または自身の場合は何もしない
            return;
        }else{
            // 上記以外はフォローする
            $this->followings()->attach($userId);
            return;
        }
    }
    
    // このユーザがアンフォローする機能
    public function unfollow($userId)
    {
        // すでにフォローしているか
        $exist = $this->is_following($userId);
        
        // 自身かどうか
        $its_me = $this->id == $userId;
        
        if($exist && !$its_me){
            // ファロー済み、かつ、自身でない場合はフォローを外す
            $this->followings()->detach($userId);
            return;
        }else{
            // 上記以外は何もしない
            return;
        }
    }
    
    // すでにフォローしていればtrueを返す
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    // 自身とフォロー中のユーザの投稿だけに絞る
    public function feed_posts()
    {
        // このユーザがフォロー中のユーザのidを取得して配列にする
        $userIds = $this->followings()->pluck('users.id')->toArray();
        
        // このユーザのidもその配列に追加
        $userIds[] = $this->id;
        
        // それらのユーザが所有する投稿に絞り込む
        return Post::whereIn('user_id', $userIds);
    }
    
    // このユーザがいいねする投稿（favoritesテーブルとPostモデルの関係を定義）
    // いいね一覧を取得できる関数を作る
    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id')->withTimestamps();
    }
    
    // いいね機能の定義
    public function favorite($user_id, $post_id)
    {
        // すでにいいねしていたらtrueを返す
        $exist = $this->is_favorite($post_id);
        
        if($exist == true){
            // すでにいいねしていたら何もしない
            return;
        }else{
            // Favoritesクラスをインスタンス化
            $favoritesModel = new Favorites();
            
            // user_idをレコードに追加
            $favoritesModel->user_id = $user_id;
            
            // post_idをレコードに追加
            $favoritesModel->post_id = $post_id;
            
            // テーブルを保存
            $favoritesModel->save();
            
            return;
        }
    }
    
    // いいね解除機能の定義
    public function unfavorite($user_id, $post_id)
    {
        // すでにいいねしていたらtrueを返す
        $exist = $this->is_favorite($post_id);
        
        if($exist == true){
            // Favoritesクラスをインスタンス化
            $favoritesModel = new Favorites();
            
            // user_idとpost_idが一致していて、いいねされている投稿をテーブルから削除
            $favoritesModel
            ->where('user_id', $user_id)
            ->where('post_id', $post_id)
            ->delete();
            
            return;
        }else{
            // いいねしていなければ何もしない
            return;
        }
    }
    
    // すでにいいねしている投稿か調べる
    public function is_favorite($post_id)
    {
        // すでにいいねされていたらtrueを返す
        return $this->favorites()->where('post_id', $post_id)->exists();
    }
    
    // いいねした投稿だけを表示する
    public function feed_favorites()
    {
        // ユーザがいいねした投稿を配列で取得
        $favoriteIds = $this->favorites()->pluck('posts.id')->toArray();
        
        // このユーザがいいねした投稿に絞り込む
        return Post::whereIn('id', $favoriteIds);
    }
}