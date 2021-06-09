<?php

namespace App\Models;

use App\Models\User;
use App\Models\Follow;
use DB;

trait FollowableTrait
{
    public function follow(User $user){
        // $follow = (Follow::all()->first());
        // first()可轉為model
        
        $auth = auth()->user();
        if($auth->unfollowing($user)){
            return Follow::where('user_id', auth()->id())
            ->where('following_user_id', $user->id)
            ->update(['followed'=>true]);
            // 若登入者未追蹤此$user($followed = 0)
        }else{
            return Follow::create([
                'user_id' => auth()->id(),
                'following_user_id' => $user->id,
                'followed' => true,
                // 若登入者未追蹤此$user(尚未有數據)
            ]);
        }       
        // 之前未加入followed參數的寫法
        // return $this->follows()->save($user);
    }

    public function unfollow(User $user){
        $auth = auth()->user();
        if($auth->following($user)){
            return Follow::where('user_id', auth()->id())
                ->where('following_user_id', $user->id)
                ->update(['followed'=>false]);   
                // 若登入者追蹤此$user($followed = 1)    
            }else{
                return Follow::create([
                    'user_id' => auth()->id(),
                    'following_user_id' => $user->id,
                    'followed' => false,
                    // 若登入者追蹤此$user(尚未有數據)
            ]);
        }
        // return $this->follows()->detach($user);
        // 與此$user取消連接
    }

    public function following(User $user){
        return $this->follows()->where('following_user_id', $user->id)->where('followed', 1)->exists();
        // 使用者follows裡，有following_user_id = $user->id
    }

    public function unfollowing(User $user){
        return $this->follows()->where('following_user_id', $user->id)->where('followed', 0)->exists();
        // 使用者follows裡，有following_user_id = $user->id
    }

    public function toggleFollow(User $user){
        if($this->following($user)){
            return $this->unfollow($user);
        }
        return $this->follow($user);

        // $this->follows()->toggle($user);
        // 上則表述，為簡化版本
    }

    public function followings(){
        return $this->follows()->where('followed', 1);
    }

    public function followers(){
        return $this->followings()->where('user_id', auth()->id())->count();
    }

    public function followeds(User $user){
        // 不是登入者的id
        return $this->followings()->where('following_user_id', $user->id)->count();
    }

    public function follows(){
        return $this->belongsToMany(
            User::class, 
            'follows', 
            'user_id', 'following_user_id'
        );
        // 一個User可以被很多人follow

        // table的名稱應莫認為users_users，強制改為follows
        // 由於客制化的key，應特別強調$foreignPivotKey、$relatedPivotKey
    }
}