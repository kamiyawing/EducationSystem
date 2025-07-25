<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * トップページ用メソッド
     * トップページにお知らせ一覧を表示する
     */
    // public function showTop() {
    //     DBから記事一覧を取得（例：最新順に並び替え）
    //     $articles = Article::orderBy('created_at', 'desc')->get();
    //     トップページのビュー（例：user.top）に記事一覧($articles)を渡す
    //     return view('user.top', compact('articles'));
    // }

    /**
     * お知らせ一覧専用ページ
     */
    public function articlesList() {
        // 例：既存のモデル側メソッドを利用して記事一覧を取得
        $articlesModel = new Article();
        $articles = $articlesModel->articleGetList();
        return view('user.article_list', compact('articles'));
    }

    /**
     * お知らせ詳細ページ（旧メソッド）
     */
    public function articlesDetail($id) {
        // find で１件取得（記事が存在しない場合は null となるので、必要に応じてfindOrFail()の利用も検討してください）
        $article = Article::find($id);
        return view('user.article', compact('article'));
    }

    /**
     * お知らせ詳細ページ（新規に追加するメソッド）
     * ルート定義：Route::get('/article/{id}', [ArticleController::class, 'showArticle'])->name('show.article')
     */
    public function showArticle($id) {
        // 記事が存在しない場合は自動的に 404 エラーとなるように
        $article = Article::findOrFail($id);
        return view('user.article', compact('article'));
    }
}
