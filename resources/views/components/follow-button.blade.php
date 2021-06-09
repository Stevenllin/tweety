@unless(current_user()->is($user)) 
    <form method="POST" action="{{ route('follow', $user->username) }}">
        @csrf
        <button 
                type="submit"
                class="bg-blue-500 rounded-full shadow px-4 py-2 text-white text-xs"
            >
                {{ current_user()->following($user) ? 'Unfollow Me' : 'Follow Me' }}
            <!-- 若登入的user已經follow過此user顯示Unfollow Me，反之顯示Follow Me -->
            </button>
    </form>
@endunless
<!-- 只要登入使用者不是這個$user就顯示 -->