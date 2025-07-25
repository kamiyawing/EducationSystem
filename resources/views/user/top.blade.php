@extends('user.layouts.app')

@section('title', 'トップページ')

@section('banner')
<div class="row mb-4">
    <div class="col-md-8 offset-md-2 text-center">
        <!-- 初期表示のバナー画像 -->
        <img id="banner-image" src="{{ asset('storage/images/banner/banner1.png') }}" alt="バナー画像" class="img-fluid">
        <div class="mt-2">
            <!-- ボタンタグに変更（aタグではなく）、クリック時にページ遷移しないように設定 -->
            <button type="button" id="switch-banner-button" data-current-banner-id="1" class="btn btn-secondary">
                バナー切替
            </button>
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
                    <!-- DBから取得した記事データ($articles)をループで表示 -->
                    <ul class="list-group">
                        @foreach($articles as $article)
                            <li class="list-group-item">
                                <strong>{{ $article->created_at->format('Y-m-d') }}</strong> -
                                <!-- タイトルをaタグで囲み、詳細ページへのリンク（ルート名「article」）とする -->
                                <a href="{{ route('show.article', $article->id) }}">
                                    {{ $article->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- jQuery の読み込み -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#switch-banner-button').on('click', function(e) {
        // クリック時のデフォルト動作（ページ遷移）を防止
        e.preventDefault();
        
        // 現在表示中のバナーIDをdata属性から取得
        var currentId = $(this).data('current-banner-id');
        
        // Ajaxでバナー切替APIを呼び出す
        $.ajax({
            url: "{{ route('banner.switch') }}",
            method: "GET",
            data: { current_banner_id: currentId },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // 返却された image_url で画像を更新
                    $('#banner-image').attr('src', response.image_url);
                    // 次回呼び出し用の current_banner_id を更新
                    $('#switch-banner-button').data('current-banner-id', response.banner_id);
                } else {
                    alert('バナーの切り替えに失敗しました。');
                }
            },
            error: function(xhr, status, error) {
                alert('エラーが発生しました: ' + error);
            }
        });
    });
});
</script>
@endsection
