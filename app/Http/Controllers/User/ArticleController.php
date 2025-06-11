<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function articlesList() {
        $articlesModel = new Article();
        $articles = $articlesModel->articleGetList();
        return view('user/article_list', compact('articles'));
    }

    public function articlesDetail($id) {
        $article = Article::find($id);
        return view('user/article', compact('articles'));
    }
}