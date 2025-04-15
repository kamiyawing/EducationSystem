@extends('layouts.app')

@section('content')
<div class="container">

{{-- 戻るボタン --}}
    <a href="{{ route('admin.top') }}" class="btn btn-secondary">戻る</a>

    
    <h2 class="mb-4">バナー管理</h2>

    {{-- アップロードフォーム --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- アップロード済み画像の一覧 --}}
    <h4 class="mt-5">アップロード済み画像一覧</h4>
    <div class="row">
        @forelse ($files as $file)
            @php
                $filename = basename($file);
            @endphp
            <div class="col-md-3 text-center mb-4">
                <img src="{{ asset('storage/banners/' . $filename) }}" class="img-fluid" style="height: 150px;">
                <form method="POST" action="{{ route('admin.banner.delete', $filename) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm mt-2">削除</button>
                </form>
            </div>
            @empty
            <p>画像がまだありません。</p>
            @endforelse

    </div>

    
    {{-- アップロードフォーム --}}
            <form method="POST" action="{{ route('admin.banner.upload') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="banner" class="form-label">画像ファイルを選択</label>
            <input class="form-control" type="file" name="banner" required>
        </div>
        <button class="btn btn-primary">登録</button>
    </form>
    

    
</div>
@endsection