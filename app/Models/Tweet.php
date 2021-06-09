<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory, LikableTrait;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    
        // 可在php artisan tinker
        // use App\Models\{User,Tweet};
        // Tweet::factory()->for(User::factory())->count(5)->create();
        // Tweet::factory()->forUser()->count(5)->create();
        // Tweet::factory()->forUser()->count(5)->create(['user_id' => '1']);
        // 可創建Tweet五筆給予User

        // $user->each(function($user){Tweet::factory()->count(5)->create(['user_id' => $user->id]);});
        // 每個使用者創建五筆Tweet
    }

}
