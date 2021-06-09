<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, FollowableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'avatar',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tweets(){
        return $this->hasMany(Tweet::class)->latest();
        // 僅可看到自己user的tweets最新
        
        // 可在php artisan tinker中的 use App\Models\{User,Tweet};
        // User::factory()->hasTweets(5)->create();
        // 一次創建5筆資料
    }

    public function timeline(){
        $ids = $this->follows()->pluck('id');
        // 抓user follows的id
        $ids->push($this->id);
        // 將自己的id填入此陣列
        return Tweet::whereIn('user_id', $ids)->withLikes()->latest()->paginate(5);
        // withLikes()抓取有關Likes資訊
        // 可抓取自己的貼文以及其他follows的貼文

        // 另一種寫法
        // $friends = $this->follows()->pluck('id');
        // return Tweet::whereIn('user_id', $friends)->orWhere('user_id', $this->id)->latest()->get();
    }

    public function getAvatar(){    
        $avatar = $this->avatar;

        if($avatar == null){
            return '/storage/' . 'avatars/Lebron.png';
            // Default此user的頭像
        }else{
            return '/storage/' . $avatar;
            // 回傳User的頭像
        }
        // getAvatarAttribute是Laravel特別function
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
        // 加密
    }

    public function getRouteKeyName(){
        return 'name';
        // 為了讓URL中的profiles/{user}可寫入user的name
        // {{ route('profile', $tweet->user) }}默認指向user的name，若沒有則默認指向user的id
    }

    public function path($append = ''){
        $path = route('profile', $this->username);

        return $append ? "{$path}/{$append}" : $path;
        // 若有傳入$append，則回傳{$path}/{$append}
        // 若沒有傳入，則回傳$path
    }
}
