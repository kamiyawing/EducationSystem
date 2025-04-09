<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>授業一覧</title>
</head>
<body>
    <div class="bg-dark text-white py-4 fs-3">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
    
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 gap-4">
                    <li><a href="#" class="nav-link px-2 text-white">授業管理</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">お知らせ管理</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">バナー管理</a></li>
                </ul>
    
                <div class="text-end">
                    <button type="button" class="btn btn-light btn-lg">ログアウト</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>

    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
</body>
</html>