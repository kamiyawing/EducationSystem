<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
   <!-- ヘッダー -->
   <div class="d-flex justify-content-between align-items-center p-3" style="background-color: #9EE9F7;">
        <div>
         <a href="{{ route('admin.curriculum') }}" class="btn btn-secondary">授業管理</a>
         <a href="{{ route('admin.article') }}" class="btn btn-secondary">お知らせ管理</a>
         <a href="{{ route('admin.banner') }}" class="btn btn-secondary">バナー管理</a>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
         @csrf
          <button type="submit" class="btn btn-link text-white">ログアウト</button>
        </form>
    </div>

        <main class="py-4">
            @yield('content')
        </main>
</body>
</html>
