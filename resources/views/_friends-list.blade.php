<div class="bg-gray-200 rounded-lg py-4 px-6 border border-gray-300">
    <h3 class="font-bold text-xl mb-4">Followings</h3>

    <ul>
        @forelse(auth()->user()->followings as $user)
        <!-- User的follows人中每一個人$user -->
            <li class="{{ $loop->last ? '' : 'mb-4' }}">
            <!-- 若是最後一個則沒有mb-4，其餘都有 -->
                <div>
                    <a href="{{ route('profile', $user->username) }}" class="flex items-center text-sm">
                        <img src="{{ $user->getAvatar() }}" 
                            alt=""
                            class="rounded-full mr-2"
                            width="40"
                            height="40"
                        >{{ $user->username }}
                        <!-- https://i.pravatar.cc/40 40為圖片px大小 -->
                        <!-- flex將水平排列 -->
                    </a>
                </div>
            </li>
        @empty
        <li>No friends yet</li>
        <!-- 若沒有follows，則顯示 -->
        @endforelse
    </ul>
</div>