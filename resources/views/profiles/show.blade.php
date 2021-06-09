<x-app>
    <header class="relative">
        <div class="relative">
            <img
                src="/images/lakers.jpg"
                alt=""
                class="mb-2 rounded-lg"
            >

            <img src="{{ $user->getAvatar() }}" 
                alt=""
                class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
                style="left: 50%"
                width="150"
            >
            <!-- transform -translate-x-1/2 translate-y-1/2課堂62 -->
        </div>
    </header>

    <div class="flex justify-between items-center mb-12">
        <div style="max-width: 270px">
            <h2 class="font-bold text-2xl mb-1">{{$user->name}}</h2>
            <div class="flex items-center">
                <p class="font-bold text-2xl mr-1">{{ $Newnumber }}</p>
                    <span class="text-l mr-3">Fans</span>
                <p class="font-bold text-2xl mr-1">{{ $user->followers() }}</p>
                    <span class="text-l">Follows</span>
            </div>
            <p class="text-sm">Joined in {{ $user->created_at->diffForHumans() }}</p>
            <!-- diffForHumans將時間為倒數幾日 -->

        </div>
        <!-- 設定最大寬度為270px，超過字數會換行 -->

        <div class="flex">
            <!-- 寫法一 -->
            <!-- @if(current_user()->is($user)) -->

            <!-- 寫法二 -->
            @can('edit', $user)
                <a 
                    href="{{ $user->path('edit') }}"
                    class="rounded-full border border-gray-300 px-4 py-2 text-black text-xs mr-2"
                >
                Edit Profile
                    <!-- append傳入edit  -->
                </a>
            @endcan
            <!-- @endif -->

            <!-- 如果登入使用者為這個$user，則顯示 -->
            <!-- 此current_user()為客制地global的方法，在helpers.php -->
            
            <x-follow-button :user="$user"></x-follow-button>
            <!-- 將$user代入至此components -->
        </div>
        <!-- items-center將幾個元件對齊位置 -->

    </div>

    <p class="text-sm mb-4">
        Mailtrap uses cookies to enhance your browsing experience, analyze traffic and serve targeted ads. By continuing to use our site and application, you agree to our Privacy Policy and use of cookies.
    </p>


    @include('_timeline', [
        'tweets' => $tweets
    ])
    <!-- 僅顯示僅此user的tweets -->

</x-app>