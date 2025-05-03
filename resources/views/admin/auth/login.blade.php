@php($noHeader = true)
@extends('admin.layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- 新規登録リンク -->
            <div class="text-end">
                <a href="{{ route('admin.register.form') }}" class="text-muted">新規会員登録はこちら</a>
            </div>

            <!-- タイトル -->
            <h2 class="text-center mb-4" style="font-weight: bold;">管理画面ログイン</h2>

            <!-- カードデザイン -->
            <div class="card p-4 shadow-sm">  
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.login.form') }}">
                        @csrf

                        <!-- メールアドレス -->
                        <div class="mb-3">
                            <label for="email" class="form-label">メールアドレス</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" >
                            @error('email')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- パスワード -->
                        <div class="mb-3">
                            <label for="password" class="form-label">パスワード</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" >
                            @error('password')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <!-- ログインボタン -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark w-100 py-2">ログイン</button>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 