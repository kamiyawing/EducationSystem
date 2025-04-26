@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">  
            <div class="text-end">
                <a href="{{ route('user.login.form') }}" class="text-muted">ログインはこちら</a> 
            </div>
            <h2 class="text-center mb-4" style="font-weight: bold;">新規ユーザー登録</h2>

            <div class="card p-4 shadow-sm">  
                <div class="card-body">
                    <form method="POST" action="{{ route('user.register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">ユーザーネーム</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kana" class="form-label">カナ</label>
                            <input id="kana" type="text" class="form-control @error('kana') is-invalid @enderror" 
                                   name="kana" value="{{ old('kana') }}">
                            @error('kana')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">メールアドレス</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">パスワード</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password">
                            @error('password')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">パスワード確認</label>
                            <input id="password-confirm" type="password" class="form-control" 
                                   name="password_confirmation">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-dark w-100 py-2">登録</button>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection