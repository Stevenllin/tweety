<div class="border border-grey-300 rounded-lg" style="max-width: 900px">
    @forelse($tweets as $tweet)
        @include('_tweet')
    @empty
        <p class="p-4">No tweets yet.</p>
        <!-- 若沒有貼文則顯示 -->
    @endforelse
    <!-- 貼文欄位 -->
    <!-- max-width最大寬度給予900px -->

    {{ $tweets->links() }}
    <!-- 產生頁籤 -->
</div>