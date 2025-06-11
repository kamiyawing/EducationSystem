@extends('user.layouts.app')

@section('title', 'プロフィール設定')

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
            <a href="{{ route('home') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>

    <!-- プロフィール設定フォーム -->
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header text-center">プロフィール設定</div>
                <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                  @method('PUT')

                        @csrf

                        <!-- プロフィール画像 -->
                        <div class="mb-3 text-center">
                            <img src="{{ asset(Auth::user()->profile_image ?? '/storage/images/profile/noimage.jpg') }}" 
                                 alt="プロフィール画像" 
                                 class="rounded-circle img-fluid" 
                                 style="max-width: 150px;">
                            <input type="file" name="profile_image" class="form-control mt-2">
                            <!-- 画像削除チェック -->
                            <div class="mt-2">
                                <input type="checkbox" name="remove_profile_image" id="remove_profile_image">
                                <label for="remove_profile_image">現在の画像を削除</label>
                            </div>
                        </div>

                        <!-- ユーザーネーム -->
                        <div class="mb-3">
                            <label for="name" class="form-label">ユーザーネーム</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- カナ -->
                        <div class="mb-3">
                            <label for="name_kana" class="form-label">カナ</label>
                            <input type="text" name="name_kana" id="name_kana" class="form-control @error('name_kana') is-invalid @enderror" 
                                   value="{{ old('name_kana', Auth::user()->name_kana) }}" required>
                            @error('name_kana')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- メールアドレス -->
                        <div class="mb-3">
                            <label for="email" class="form-label">メールアドレス</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- パスワード設定リンク -->
                        <div class="mb-3 text-center">
                            <a href="{{ route('password.edit') }}" class="btn btn-link">パスワードを変更する</a>
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
