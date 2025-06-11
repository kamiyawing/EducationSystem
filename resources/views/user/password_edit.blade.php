@extends('user.layouts.app')

@section('title', 'パスワード変更')

@section('content')
<div class="container py-4">
    <!-- ナビゲーションボタン -->
    <div class="row mb-3 text-center">
        <div class="col-md-3 mb-2">
            <a href="{{ route('schedule.index') }}" class="btn btn-primary w-100">時間割</a>
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

    <!-- 戻るボタン -->
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <a href="{{ route('profile.edit') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>

    <!-- パスワード変更フォーム -->
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header text-center">パスワード変更</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- 旧パスワード -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">旧パスワード</label>
                            <input type="password" name="current_password" id="current_password" 
                                   class="form-control @error('current_password') is-invalid @enderror" required>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- 新パスワード -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label">新パスワード</label>
                            <input type="password" name="new_password" id="new_password" 
                                   class="form-control @error('new_password') is-invalid @enderror" required>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- 新パスワード確認 -->
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">新パスワード確認</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                                   class="form-control @error('new_password_confirmation') is-invalid @enderror" required>
                            @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- 登録ボタン -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">登録</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
