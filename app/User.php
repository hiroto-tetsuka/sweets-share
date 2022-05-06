<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * このユーザが所有する投稿。（ Micropostモデルとの関係を定義）
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    /**
     * このユーザがフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    /**
     * このユーザをフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount(['posts', 'followings', 'followers']);
    }
    
    // フォロー機能
    public function follow($userId)
    {
        // すでにフォローしているか
        $exist = $this->is_following($userId);
        // 自身かどうか
        $its_me = $this->id == $userId;
        
        if($exist || $its_me){
            // フォロー済み、または自身の場合は何もしない
            return false;
        }else{
            // 上記以外はフォローする
            $this->followings()->attach($userId);
            return true;
            
            // こっちでは動かない？
            // $userModel = new User;
            // $userModel->id = $userId;
            // $userModel->save();
            // return true;
        }
    }
    
    // アンフォロー機能
    public function unfollow($userId)
    {
        // すでにフォローしているか
        $exist = $this->is_following($userId);
        // 自身かどうか
        $its_me = $this->id == $userId;
        
        if($exist && !$its_me){
            // ファロー済み、かつ自身でない場合はフォローを外す
            $this->followings()->detach($userId);
            return true;
            
            // こっちでは動かない？
            // $userModel = new User;
            // $userModel->id = $userId;
            // $userModel->save();
            // return true;
        }else{
            // 上記以外は何もしない
            return false;
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
}