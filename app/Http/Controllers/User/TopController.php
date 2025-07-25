<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article; // Articleモデルを読み込む

class TopController extends Controller
{
    public function index()
    {
        // 最新5件の記事を取得する例（必要に応じて変更してください）
        $articles = Article::orderBy('created_at', 'desc')->take(5)->get();
        
        // ビュー 'user.top' に $articles を渡す
        return view('user.top', compact('articles'));
    }
}
