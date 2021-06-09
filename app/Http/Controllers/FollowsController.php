<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\FollowingNotification;
use App\Notifications\FollowedNotification;
use Illuminate\Support\Facades\Notification;


class FollowsController extends Controller
{
    public function store(User $user){
        // if(current_user()->following($user)){
            // auth()->user()->unfollow($user);
            // 若登入使用者，follows中有$user，則unfollow
        // }else{
            // auth()->user()->follow($user);
            // 反之，follow
        // }
        // 可被FollowableTrait中的toggleFollow取代
        
        auth()->user()->toggleFollow($user);

        $followeds = request()->user();
        Notification::send(request()->user(), new FollowingNotification($user));
        // 若follow此$user，傳遞此訊息給登入者
        
        Notification::send($user, new FollowedNotification($followeds));
        // 若未follow此$user，傳遞此訊息給被追蹤者$user

        return back();
        // 回到上一頁
    }
}
