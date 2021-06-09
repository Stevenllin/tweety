<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ExploreController extends Controller
{
    public function __invoke(){
        $users = User::all()->flatten()->all();
        // 從collection壓成為二維陣列

        for($row = 0; $row < count($users); $row++){
            if ($users[$row]['avatar'] == null){
                $users[$row]['avatar'] = 'avatars/Lebron.png';
                // 若avatar為空值，預設圖片給予
            }
            $users[$row]['avatar'] = '/storage/' . $users[$row]['avatar'];
        }

        return view('/explore', [
            'users' => $users,
        ]);
    }
    // 若controller只有維一function，且web上不標註方法，則function需命名為__invoke才能使用
}
