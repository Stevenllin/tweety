<x-app>
    <header class="relative mb-12">
        <div class="relative">
            <img
                src="/images/lakers.jpg"
                alt=""
                class="mb-2 rounded-lg"
            >

            <img src="{{ $auth->getAvatar() }}" 
                alt=""
                class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
                style="left: 50%"
                width="150"
            >
            <!-- transform -translate-x-1/2 translate-y-1/2課堂62 -->
        </div>
            <div class="font-bold text-xl mt-8">
                You have {{ $unReadNumber }} unread messages
            </div>
    </header>

    <div class="border border-grey-300 rounded-lg p-2" style="max-width: 900px">
        <ul>
            @forelse($notifications as $notification)
                <div class="{{ $loop->last ? '' : 'border-b border-b-grey-400' }} p-2" style="max-width: 900px">

                    @if($notification->type === 'App\Notifications\FollowedNotification')
                        <li class="font-bold">{{ $notification->data['followeds']['username'] }} have followed You</li>
                        <li class="text-green-500 text-sm">{{ $notification->created_at->diffForHumans() }}</li>
                    @endif

                    @if($notification->type === 'App\Notifications\FollowingNotification')
                        <li class="font-bold">You have followed {{ $notification->data['user']['username'] }}</li>
                        <li class="text-green-500 text-sm">{{ $notification->created_at->diffForHumans() }}</li>
                    @endif
                </div>
            @empty
                <li class="font-bold">You have no unread notifications at this time</li>
            @endforelse
        </ul>
    </div>
</x-app>