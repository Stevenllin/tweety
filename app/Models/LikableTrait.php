<?php

namespace App\Models;

use App\Models\Tweet;
use Illuminate\Database\Eloquent\Builder;

trait LikableTrait
{
    public function scopeWithLikes(Builder $query){
        $query->leftJoinSub(
            'select tweet_id, sum(liked) as likes, sum(!liked) as dislikes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }
    // left Join likes table
    // likes.tweet_id = tweets.id
    // 可在Tweet::withLikes()->get()抓取到有關likes, dislikes總數

    public function likes(){
        return $this->hasMany(like::class);
    }

    public function like($user = null, $liked = true){
        $this->likes()->updateOrCreate(
            [
                'user_id' => $user ? $user->id : auth()->id(),
                // 若有給予$user取得該$user的id，反之，預設給予此登入者
            ],[
                'liked' => $liked,
            ]
        );
    }
    // 更新或是創建like

    public function dislike($user = null){
        return $this->like($user, false);
    }
    // 更新或是創建dislike，將false代入like()

    public function isLikedBy(){
        $id = auth()->id();

        return $this->likes()
        ->where('tweet_id', $this->id)
        ->where('liked', true)
        ->where('user_id', $id)
        ->count();
    }

    public function isDislikedBy(){
        $id = auth()->id();

        return $this->likes()
        ->where('tweet_id', $this->id)
        ->where('liked', false)
        ->where('user_id', $id)
        ->count();
    }
}