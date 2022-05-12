<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // この投稿を所有するユーザ（Userモデルとの関係を定義）
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // この投稿をいいねするユーザ（Userモデルとの関係を定義）
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')->withTimestamps();
    }
}
