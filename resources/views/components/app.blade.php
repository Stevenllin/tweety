<x-master>
    <section>
        <main>
            <div class="lg:flex lg:justify-between">
                <div class="lg:flex">
                    @if(auth()->check())
                        <div class="ml-4">
                            @include ('_sidebar-links')
                            <!-- 側邊欄位 -->
                        </div>
                    @endif
                    <!-- 若不加入auth()->check()，register頁面將報錯，因為會假設已經login成功 -->
                        </div>

                        <div class="lg:flex-1 lg:mx-10">
                            {{ $slot }}
                        </div>

                        @if(auth()->check())
                            <div class="lg:w-1/6">
                                @include ('_friends-list')
                                <!-- 朋友側邊欄位 -->
                                <!-- lg:為large screen -->
                                <!-- bg-blue背景顏色 -->
                            </div>
                        @endif
                </div>  
            </div>
        </main>
    </section>
</x-master>