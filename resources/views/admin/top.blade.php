@extends('layouts.app')

@section('content')
<div class="container">

    <!-- ユーザー情報 -->
    <div class="mt-4">
        <div class="card p-4">
            <p>ユーザーネーム：{{ Auth::guard('admin')->user()->name }}</p>
            <p>メールアドレス：{{ Auth::guard('admin')->user()->email }}</p>
        </div>
    </div>
</div>
@endsection