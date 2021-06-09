<ul>
    <li>
        <a  class="font-bold text-lg mb-4 block"
            href="{{ route('home') }}"
            >Home
        </a>
    </li>

    <li>
        <a  class="font-bold text-lg mb-4 block"
            href="/explore"
            >Explore
        </a>
    </li>

    <li>
        <a  class="font-bold text-lg mb-4 block"
            href="/notifications"
            >Notifications
        </a>
    </li>

    <li>
        <a  class="font-bold text-lg mb-4 block"
            href="#"
            >bookmarks
        </a>
    </li>

    <li>
        <a  class="font-bold text-lg mb-4 block"
            href="#"
            >Lists
        </a>
    </li>

    <li>
        <a  class="font-bold text-lg mb-4 block"
            href="{{ route('profile', auth()->user()->username) }}"
            >Profile
        </a>
        <!-- 回傳至自己的profile頁面 -->
    </li>

    <li>
        <form action="/logout" method="POST">
            @csrf

            <button class="font-bold text-lg">Logout</button>
        </form>
    </li>
</ul>