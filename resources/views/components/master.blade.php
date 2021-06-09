<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
    <body>
        <div id="app">
            <section class="mb-2"> 
                <header class="container mx-auto">
                    <h1>
                        <img src="{{ asset('/images/ins.png') }}"
                            alt=""                     
                            width="200"
                            height="200"
                        >
                    </h1>
                            <!-- asset()相對路徑的寫法，絕對路徑會抓不到 -->
                            <!-- asset()方法用於引入CSS/JavaScript/images等文件，文件必須放在public文件底下 -->
                            <!-- url()方法生成一個完整網址 -->

                            <!-- src="http://127.0.0.1:8000/images/ins.png" -->
                            <!-- src="/images/ins.png" -->
                            <!-- src="{{ asset('/images/ins.png')}}" -->
                            <!-- 三種寫法皆可 -->
                </header>
            </section>

            {{ $slot }}
        </div>

        <script src="http://unpkg.com/turbolinks"></script>
        <!-- 加速網站速度 -->
    </body>
</html>
