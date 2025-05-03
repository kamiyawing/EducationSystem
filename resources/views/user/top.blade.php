@extends('layouts.app')

@section('content')
<div class="container">
    <!-- ヘッダー -->
    <div class="d-flex justify-content-between align-items-center p-3" style="background-color: #9EE9F7;">
        <div>
         <a href="{{ route('user.curriculum') }}" class="btn btn-secondary">時間割</a>
        </div>
        <form method="POST" action="{{ route('user.logout') }}" class="d-inline">
         @csrf
          <button type="submit" class="btn btn-link text-white">ログアウト</button>
        </form>
    </div>

    <!-- ユーザー情報 -->
    <div class="mt-4">
        <div class="card p-4">
            <p>ユーザーネーム：{{ Auth::guard('user')->user()->name }}</p>
            <p>メールアドレス：{{ Auth::guard('user')->user()->email }}</p>
        </div>
    </div>
</div>
@endsection