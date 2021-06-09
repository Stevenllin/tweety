<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show(User $user){
        $followeds = User::all();

        $Newnumber = 0;
        // 預設為0
        for($row = 0; $row < count($followeds); $row++){
            $number = $followeds[$row]->followeds($user);
            // 單一User的followeds的數字
            $Newnumber = $Newnumber + $number;
            // 逐一加起來上一筆的
        }
        
        return view('profiles.show', [
            'user' => $user,
            'tweets' => $user->tweets()->withlikes()->paginate(3),
            'Newnumber' => $Newnumber
        ]);
    }

    public function edit(User $user){
        // 寫法一
        // if($user->isNot(current_user())){
        //     abort(404);
        // }

        // 寫法二
        // abort_if($user->isNot(current_user()), 404);

        // 若user不是這個使用者，則回傳404錯誤
        
        // 寫法三
        // $this->authorize('edit', $user); 
        // 此寫法為Policies，若user不是這個使用者，則回傳403錯誤


        return view('profiles.edit', compact('user'));
    }

    public function update(User $user){

        $attributes = request()->validate([
            'username' => [
                'string',
                'required',
                'max:255',
                'alpha_dash',
                Rule::unique('users')->ignore($user->id),
            ],
            // 因為在資料庫中已存在$user的資料username，所以會一直跳unique的錯誤訊息，因此需加入ignore

            'name' => ['string', 'required', 'max:255'],  

            'avatar' => ['file'],

            'email' => [
                'string',
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),                
            ],

            'password' => [
                'string',
                'required',
                'min:8',
                'max:255',
            ]
        ]);
        if(request('avatar')){
            $attributes['avatar'] = request('avatar')->store('avatars');
            // 將圖片的位置路徑存至avatars這個檔案

            // 若有更新圖片檔案則執行此動作
        }
        

        // 若要傳入到storage/app/public的檔案，則要去.env檔案設定
        // 若要再傳入至public/images，則要再輸入command，php artisan storage:link
        $user->update($attributes);

        return redirect($user->path());
    }
}
