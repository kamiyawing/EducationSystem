@extends('user.layouts.app')

@section('content')
<div class="container">

    <!-- ユーザー情報 -->
    <div class="mt-4">
        <div class="card p-4">
            <p>ユーザーネーム：{{ Auth::guard('user')->user()->name }}</p>
            <p>メールアドレス：{{ Auth::guard('user')->user()->email }}</p>
        </div>
    </div>
</div>
@endsection