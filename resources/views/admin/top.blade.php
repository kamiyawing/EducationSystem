@extends('layouts.app')

@section('content')
<div class="container">
    <!-- ヘッダー -->
    <div class="d-flex justify-content-between align-items-center p-3" style="background-color: #9EE9F7;">
        <div>
            <button class="btn btn-secondary">授業管理</button>
            <button class="btn btn-secondary">お知らせ管理</button>
            <button class="btn btn-secondary">バナー管理</button>
        </div>
        <<form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
         @csrf
          <button type="submit" class="btn btn-link text-white">ログアウト</button>
        </form>
    </div>

    <!-- ユーザー情報 -->
    <div class="mt-4">
        <div class="card p-4">
            <p>ユーザーネーム：{{ Auth::guard('admin')->user()->name }}</p>
            <p>メールアドレス：{{ Auth::guard('admin')->user()->email }}</p>
        </div>
    </div>
</div>
@endsection