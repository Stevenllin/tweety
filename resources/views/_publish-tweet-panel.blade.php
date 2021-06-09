<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
            <form method="POST" action="/tweets">
                @csrf

                <textarea name="body" 
                          class="w-full" 
                          placeholder="What's up doc?"
                          required
                          autofocus
                >

                </textarea>
                    <!-- w-full width開到滿 -->
                <hr class="my-4">


                <footer class="flex justify-between items-center">
                    <img src="{{ auth()->user()->getAvatar() }}" 
                         alt="your avatar"
                         class="rounded-full mr-2"
                         width="50"
                         height="50"
                    >
                    <!-- 呼叫User中的getAvatarAttribute()取得User的頭像 -->

                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 rounded-lg shadow px-10 text-sm py-2 text-white h-10 ">Tweet-a-roo!</button>
                    <!-- justify-between將頭像跟BTN分配到兩邊 -->
                </footer>
            </form>
        @error('body')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
</div>