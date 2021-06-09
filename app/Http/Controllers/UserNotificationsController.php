<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FollowedNotification;

class UserNotificationsController extends Controller
{
    public function show(User $user){     
        $auth = auth()->user();

        $user = $auth->follows;
        // 抓取登入者所follow的人

        $notifications = $auth->unreadNotifications;
        // 只接收未閱讀過得訊息

        $unReadNumber = count($notifications);
        

        $notifications->markAsRead();
        // 標註notifications已閱讀過

        return view('notifications.show', [
            'notifications' => $notifications,
            'auth' => $auth,
            'unReadNumber' => $unReadNumber
        ]);
    }
}
