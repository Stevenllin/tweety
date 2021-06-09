<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Models\User;

class TweetsController extends Controller
{
    public function index()
    {
        return view('tweets.index', [
            'tweets' => auth()->user()->timeline()
            // 呼叫User裡面的timeline()
            // 在RouteServiceProvider檔案中改/tweets，將登入後頁面改為/tweets
        ]);
    }

    public function store(){

        $attributes = request()->validate(['body' => 'required|max:255']);
        
        Tweet::create([
            'user_id' => auth()->user()->id,
            'body' => $attributes['body']
            ]);
            
            return redirect()->route('home');
        // 寫auth()->id()也可以
    }

    public function destroy(Tweet $tweet){
        $tweet->delete();

        return back();
    }
}
