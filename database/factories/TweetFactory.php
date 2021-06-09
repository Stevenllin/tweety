<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TweetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tweet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'body' => $this->faker->sentence
        ];
        // 創建Tweet的假資料
        // 在php artisan tinker中的創見指令App\Models\Tweet::factory()->make();
        // App\Models\Tweet::factory()->create();才會把資料寫入DB

        // use App\Models\{User,Tweet};
        // User::factory()->has(Tweet::factory()->count(5))->create();
        // 一次創建5筆資料
    }
}
