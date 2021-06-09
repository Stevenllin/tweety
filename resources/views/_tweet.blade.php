<div class="flex p-4 {{ $loop->last ? '' : 'border-b border-b-grey-400' }}">
<!-- laravel在blade提供像foreach一樣的變數$loop使用，若$loop執行到最後寫入''，反之為'border-b border-b-gray-400' -->
    <div class="mr-2 flex-shrink-0 w-1/16">
        <!-- <a href="{{ route('profile', $tweet->user->name) }}"> -->
        <!-- 使用web裡的name('profile')，$tweet->user是因wildcard -->
        <a href="{{ $tweet->user->path() }}">
        <!-- 此寫法也可以代替上方 -->
            <img src="{{ $tweet->user->getAvatar() }}" 
                alt=""
                class="rounded-full mr-2"
                width="50"
                height="50"
            >
        <!-- 因為頭貼受到flex影響，大小受限，透過flex-shrink-0解決 -->
        <!-- {{ $tweet->user->getAvatar() }}"呼叫User中的getAvatarAttribute()為了固定住user頭像圖片 -->
        <!-- border-b底線 -->
        </a>
    </div>

    <div>
        <h5 class="font-bold mb-0">
            <a href="{{ route('profile', $tweet->user->username) }}">
                {{ $tweet->user->username }}
            </a>
        </h5>

        <p class="text-xs text-gray-600 mb-4">
            {{ $tweet->created_at->diffForHumans() }}
        </p>

        <p class="text-sm mb-2">
            {{ $tweet->body }}
        </p>

        <div class="flex">
            <form action="/tweets/{{ $tweet->id }}/like" 
                  method="POST"
            >
            @CSRF
                <div class="flex items-center mr-4 {{$tweet->isLikedBy(current_user()) ? 'text-blue-500' : 'text-gray-500'}}">
                    <svg viewBox="0 0 20 20" class=" mr-1 w-3">
				        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					        <g class="fill-current">
						        <path d="M11.0010436,0 C9.89589787,0 9.00000024,0.886706352 9.0000002,1.99810135 L9,8 L1.9973917,8 C0.894262725,8 0,8.88772964 0,10 L0,12 L2.29663334,18.1243554 C2.68509206,19.1602453 3.90195042,20 5.00853025,20 L12.9914698,20 C14.1007504,20 15,19.1125667 15,18.000385 L15,10 L12,3 L12,0 L11.0010436,0 L11.0010436,0 Z M17,10 L20,10 L20,20 L17,20 L17,10 L17,10 Z" id="Fill-97"></path>
					        </g>
			        	</g>
	    	    	</svg>

                    <button type="submit" class="text-xs">
                        {{ $tweet->likes ?: 0 }}
                        <!-- 若沒有，回傳0 -->
                    </button>
                </div>
            </form>

            <form action="/tweets/{{ $tweet->id }}/like" 
                  method="POST"
            >
            @CSRF
            @method('DELETE')
                <div class="flex items-center {{$tweet->isDislikedBy(current_user()) ? 'text-blue-500' : 'text-gray-500'}}">
                    <svg viewBox="0 0 20 20" class="mr-1 w-3">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					        <g class="fill-current">
						        <path d="M11.0010436,20 C9.89589787,20 9.00000024,19.1132936 9.0000002,18.0018986 L9,12 L1.9973917,12 C0.894262725,12 0,11.1122704 0,10 L0,8 L2.29663334,1.87564456 C2.68509206,0.839754676 3.90195042,8.52651283e-14 5.00853025,8.52651283e-14 L12.9914698,8.52651283e-14 C14.1007504,8.52651283e-14 15,0.88743329 15,1.99961498 L15,10 L12,17 L12,20 L11.0010436,20 L11.0010436,20 Z M17,10 L20,10 L20,0 L17,0 L17,10 L17,10 Z" id="Fill-97"></path>
					        </g>
			        	</g>
		        	</svg>
            
                    <button type="submit" class="text-xs">
                        {{ $tweet->dislikes ?: 0 }}
                    </button>
                </div>
            </form>

        </div>
    </div>

    @if(current_user()->is($tweet->user))
    <div style="margin-left: auto">
    <!-- 向右靠 -->
            <form action="/tweets/{{ $tweet->id }}/delete"
                  method="POST"      
            >
            @CSRF
            @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 rounded-lg shadow px-5 text-sm py-2 text-white h-10 ">
                    DELETE
                </button>
            </form>
    </div>
    @endif
</div>