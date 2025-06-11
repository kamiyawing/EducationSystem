@extends('user.layouts.app')

@section('title', 'トップページ')

@section('banner')
<div class="row mb-4">
    <div class="col-md-8 offset-md-2 text-center">
        <img src="/storage/images/banner/banner1.jpg" alt="バナー画像" class="img-fluid">
        <div class="mt-2">
            <a href="{{ route('banner.switch') }}" class="btn btn-secondary">バナー切替</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container py-4">


    <!-- 各機能ボタン -->
    <div class="row text-center mb-4">
        <div class="col-md-3 mb-2">
        <a href="{{ route('curriculums.index') }}" class="btn btn-primary w-100">時間割</a>

        </div>
        <div class="col-md-3 mb-2">
            <a href="{{ route('progress.index') }}" class="btn btn-success w-100">授業進捗</a>
        </div>
        <div class="col-md-3 mb-2">
            <a href="{{ route('profile.edit') }}" class="btn btn-info w-100">プロフィール設定</a>
        </div>
        <div class="col-md-3 mb-2">
            @guest
                <a href="{{ route('login') }}" class="btn btn-warning w-100">ログイン</a>
            @else
                <a href="{{ route('logout') }}" class="btn btn-danger w-100"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>
    </div>

    <!-- お知らせセクション -->
    <div class="row mb-4">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header text-center">お知らせ</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>2025-03-20</strong> - 新しいカリキュラムが追加されました。
                        </li>
                        <li class="list-group-item">
                            <strong>2025-03-18</strong> - サーバーメンテナンスのお知らせ。
                        </li>
                        <li class="list-group-item">
                            <strong>2025-03-15</strong> - 春休み特別キャンペーン開始！
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
