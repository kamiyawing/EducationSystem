<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function articlesList() {
        $articlesModel = new Article();
        $articles = $articlesModel->articleGetList();
        return view('admin/article_list', compact('articles'));
    }

    public function articlesDetail($id) {
        $articlesModel = new Article();
        $articles = $articlesModel->articleGetList()->find($id);
        return view('auth/article', compact('articles'));
    }
}
